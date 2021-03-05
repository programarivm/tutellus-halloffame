<?php

namespace TutellusHall;

class Fame
{
    const PARAM_CURRENCY    = 'EUR';
    const PARAM_PRICE_MIN   = 5;
    const PARAM_PRICE_MAX   = 95;
    const PARAM_SORT        = 'publish_date';
    const PARAM_LIMIT       = 7;

    private $query;

    private $layout;

    public function __construct(array $query, string $layout)
    {
        $this->query = $query;
        $this->layout = $layout;
    }

    private function replace(array $item)
    {
        $url = str_replace('affref=undefined', 'affref='.$_ENV['AFF_REF'], $item['url']);
        $replaced = str_replace('/name/', $item['name'], $this->layout);
        $replaced = str_replace('/image_url/', $item['image_url'], $replaced);
        $replaced = str_replace('/summary/', $item['summary'], $replaced);
        $replaced = str_replace('/url/', $url, $replaced);
        $replaced = str_replace('/EUR/', $item['price']['EUR'], $replaced);

        return $replaced;
    }

    private function courses(\stdClass $query)
    {
        $url = $_ENV['API_URL'].
            "/courses?category_code={$query->category_code}&subcategory_code={$query->subcategory_code}&q={$query->q}&currency="
            .self::PARAM_CURRENCY."&price_min="
            .self::PARAM_PRICE_MIN."&price_max="
            .self::PARAM_PRICE_MAX."&sort="
            .self::PARAM_SORT."&limit="
            .self::PARAM_LIMIT;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['x-access-token: '.$_ENV['ACCESS_TOKEN']]);

        $result = curl_exec ($ch);

        return json_decode($result, true);
    }

    public function html()
    {
        $arr = [];
        foreach ($this->query as $query) {
            $result = $this->courses($query);
            if ($result) {
                $arr = array_merge($arr, $result);
            }
            sleep(1);
        }

        shuffle($arr);

        $html = '<div>';
        foreach ($arr as $item) {
            $html .= $this->replace($item);
        }
        $html .= '</div>';

        return $html;
    }
}
