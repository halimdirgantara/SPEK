<?php

namespace App\Filament\Resources\PackageResource\Pages;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PackageResource;

class CreatePackage extends CreateRecord
{
    protected static string $resource = PackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function prepareForValidation($attributes): array
    {
        // Runs before the form fields are validated when the form is submitted.
        // dd($attributes['data']['package_link']);

        $url = $attributes['data']['package_link'];

        $client = new Client();
        $crawler = $client->request('GET', $url);

        $attributes['data']['package_code'] = $crawler->filter('td.label-left:contains("Kode RUP")')->nextAll()->text();
        $attributes['data']['package_name'] = $crawler->filter('td.label-left:contains("Nama Paket")')->nextAll()->text();
        $attributes['data']['institution_name'] = $crawler->filter('td.label-left:contains("Nama KLPD")')->nextAll()->text();
        $attributes['data']['work_unit'] = $crawler->filter('td.label-left:contains("Satuan Kerja")')->nextAll()->text();
        $attributes['data']['budget_year'] = $crawler->filter('td.label-left:contains("Tahun Anggaran")')->nextAll()->text();
        $attributes['data']['work_volume'] = $crawler->filter('td.label-left:contains("Volume Pekerjaan")')->nextAll()->text();
        $attributes['data']['work_description'] = $crawler->filter('td.label-left:contains("Uraian Pekerjaan")')->nextAll()->text();
        $attributes['data']['work_specifications'] = $crawler->filter('td.label-left:contains("Spesifikasi Pekerjaan")')->nextAll()->text();
        $attributes['data']['domestic_products'] = $crawler->filter('td.label-left:contains("Produk Dalam Negeri")')->nextAll()->text() === 'Ya' ? true : false;
        $attributes['data']['small_business'] = $crawler->filter('td.label-left:contains("Usaha Kecil")')->nextAll()->text() === 'Ya' ? true : false;
        // $attributes['data']['spp_economic_aspect'] = $crawler->filter('td.label-left:contains("Aspek Ekonomi")')->nextAll()->text() === 'Ya' ? true : false;
        $spp_economic_element = $crawler->filter('td.label-left:contains("Aspek Ekonomi")');
        if ($spp_economic_element->count() > 0) {
            // If the element is found, extract the text content
            $spp_economic_text = $spp_economic_element->nextAll()->text();
            // Check if the text content indicates 'Ya' (Yes)
            $attributes['data']['spp_economic_aspect'] = trim($spp_economic_text) === 'Ya' ? true : false;
        } else {
            // Handle case where the element is not found
            $attributes['data']['spp_economic_aspect'] = false;
        }
        // $attributes['data']['spp_social_aspect'] = $crawler->filter('td.label-left:contains("Aspek Sosial")')->nextAll()->text() === 'Ya' ? true : false;
        // Extract SPP social aspect
        $spp_social_element = $crawler->filter('td.label-left:contains("Aspek Sosial")');
        if ($spp_social_element->count() > 0) {
            // If the element is found, extract the text content
            $spp_social_text = $spp_social_element->nextAll()->text();
            // Check if the text content indicates 'Ya' (Yes)
            $attributes['data']['spp_social_aspect'] = trim($spp_social_text) === 'Ya' ? true : false;
        } else {
            // Handle case where the element is not found
            $attributes['data']['spp_social_aspect'] = false;
        }

        // $attributes['data']['spp_environmental_aspect'] = $crawler->filter('td.label-left:contains("Aspek Lingkungan")')->nextAll()->text() === 'Ya' ? true : false;
        // Extract SPP environmental aspect
        $spp_environmental_element = $crawler->filter('td.label-left:contains("Aspek Lingkungan")');
        if ($spp_environmental_element->count() > 0) {
            // If the element is found, extract the text content
            $spp_environmental_text = $spp_environmental_element->nextAll()->text();
            // Check if the text content indicates 'Ya' (Yes)
            $attributes['data']['spp_environmental_aspect'] = trim($spp_environmental_text) === 'Ya' ? true : false;
        } else {
            // Handle case where the element is not found
            $attributes['data']['spp_environmental_aspect'] = false;
        }

        $attributes['data']['pre_dipa_dpa'] = $crawler->filter('td.label-left:contains("Pra DIPA / DPA")')->nextAll()->text() === 'Ya' ? true : false;

        $fundingSources = [];
        $tables = $crawler->filter('td.label-left:contains("Sumber Dana")')->nextAll(); // Exclude the header row
        // dd($tableRows->html());
        // foreach($tableRows as $tableRow) {
        //     dd($tableRow->html());
        // }
        $tableCrawler = new Crawler($tables->html());
        $tableRows = $tableCrawler->filter('table.table')->first()->filter('tr')->slice(1);
        dd($tableRows);
        $tableRows->each(function (Crawler $row) use (&$fundingSources) {
            // dd($row->filter('td')->eq(3)->text());
            $funding_source = $row->filter('td')->eq(1)->text() ?? null;
            $budget_year = $row->filter('td')->eq(2)->text() ?? null;
            $institution_name = $row->filter('td')->eq(3)->text() ?? null;
            $account_code = $row->filter('td')->eq(4)->text() ?? null;
            $budget = (int) preg_replace('/[^\d]/', '', $row->filter('td')->eq(5)->text()) ?? null;

            $fundingSources[] = [
                'funding_source' => $funding_source,
                'budget_year' => $budget_year,
                'institution_name' => $institution_name,
                'account_code' => $account_code,
                'budget' => $budget,
            ];
        });

        dd($fundingSources);
    }
}
