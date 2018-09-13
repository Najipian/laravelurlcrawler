<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;

class Crawler extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $url = 'https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste';
        $linkDepth = 1;

        // Initiate crawl
        $crawler = new \Arachnid\Crawler($url, $linkDepth);
        $crawler->traverse();

        // Get link data
        $links = $crawler->getLinks();

        // remove duplicated links
        $links = array_unique(array_column($links, 'absolute_url'));

        // if url us searched before get it , if not create anew one
        $url = Url::firstOrCreate(['url_name' => $url]);

        // delete old url links
        $url->links()->delete();

        // add newly obtained url links
        foreach($links as $link)
            $url->links()->create(['link_name' => $link]);

        echo "saved to DB";
    }
}
