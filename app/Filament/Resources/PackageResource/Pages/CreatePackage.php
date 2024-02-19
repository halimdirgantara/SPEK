<?php

namespace App\Filament\Resources\PackageResource\Pages;

use App\Filament\Resources\PackageResource;
use Filament\Resources\Pages\CreateRecord;
use Goutte\Client;

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
        $attributes['data']['spp_economic_aspect'] = $crawler->filter('td.label-left:contains("Aspek Ekonomi")')->nextAll()->text() === 'Ya' ? true : false;
        $attributes['data']['spp_social_aspect'] = $crawler->filter('td.label-left:contains("Aspek Sosial")')->nextAll()->text() === 'Ya' ? true : false;
        $attributes['data']['spp_environmental_aspect'] = $crawler->filter('td.label-left:contains("Aspek Lingkungan")')->nextAll()->text() === 'Ya' ? true : false;
        $attributes['data']['pre_dipa_dpa'] = $crawler->filter('td.label-left:contains("Pra DIPA / DPA")')->nextAll()->text() === 'Ya' ? true : false;

        dd($attributes);
    }
}
