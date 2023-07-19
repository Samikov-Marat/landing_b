<?php

namespace App\Classes\Site\HeadTags\Tags;

use App\Language;
use App\Page;
use App\Site;

class MetaTagBuilder implements TagBuilder
{
    private const AVAILABLE_DOMAIN_WITH_CONTENT = [
        'cdek-ge.com' => [
            'yandex-verification' => '58db2ec13e1f05bf',
            'google-site-verification' => 'FETZtrQHqP22gkqLXaJqKoSTioG8YbiOjp99ceLmngk',
        ],
        'cdek-il.com' => [
            'yandex-verification' => 'd5e9276f65369747',
            'google-site-verification' => 'q-8q-3DiimQTu-3cSx_B4xyQnwsI9XWjhcd9nOwJ240',
        ],
        'cdek-th.com' => [
            'yandex-verification' => 'a226ee3c2d515277',
            'google-site-verification' => 'S7PEjMV6kUkDZna3oNwmt8tV19KGJTtOc2332inPamk',
        ],
        'cdek.com.tr' => [
            'yandex-verification' => '2653250e3635b928',
            'google-site-verification' => 'RO9mwhoCpa3k7ljxKAt0vhvXbzBEzalA9NRoaRxp4Fc',
        ],
        'cdek-express.uz' => [
            'yandex-verification' => '1ae39d78faaef96b',
            'google-site-verification' => '04x6fnAkAvxzmrX8-G_DI79qyTYuqHpfl3ZidzpfY_w',
        ],
        'cdek-ae.com' => [
            'yandex-verification' => '5030e9224f78f906',
            'google-site-verification' => 'JLUtgD-Dx21gfJ3078sYSuZB3kpRoPQ5ObyZ94LVhKE',
        ],
        'cdek-az.com' => [
            'yandex-verification' => '62073373f394d2c3',
            'google-site-verification' => 'RmqTlCi7cttu8XXWc6ozO_irlYbCd9ZELZwp7AauUFU',
        ],
        'cdek-abkhazia.com' => [
            'yandex-verification' => 'ed8b89b1d0ac2e76',
            'google-site-verification' => 'fMFQ4xlZwL71GjfFIYrk0Cy0MLVIjbaiC1yk-HQvqsE',
        ],
        'cdek.vn' => [
            'yandex-verification' => 'a4ab0966b9a00482',
            'google-site-verification' => 'cFgJQC4Mv0KmD_bNCQr1dRiBBIQ1FPK1qfHh6k3g5is',
        ],
        'cdek-express.in' => [
            'yandex-verification' => 'd9f54fce02007ace',
            'google-site-verification' => '88eFYWuFqJ5msEGPOYLi2MndBy2t3ioWgEVG7WzYrYk',
        ],
        'cdek-rs.com' => [
            'yandex-verification' => 'f21a4f9945acec15',
            'google-site-verification' => '1SRI5aLvQrUX83v6Zw21xjglq8sjjVJPteo0omuhb5E',
        ],
        'cdek-bd.com' => [
            'yandex-verification' => '2fbfdd8750dacc3e',
            'google-site-verification' => 'XZxRW7ZigPxcGp35DHe3iVTGqj9yXHIWwLNez9_kAZo',
        ],
        'sam49.cdek-express.uz' => [
            'yandex-verification' => 'e321e20cf43fca98',
            'google-site-verification' => '04x6fnAkAvxzmrX8-G_DI79qyTYuqHpfl3ZidzpfY_w',
        ],
        'cdek-am.com' => [
            'yandex-verification' => '4aae3eb6022f9ec2',
            'google-site-verification' => 'FRtTnorRihVnmWwCfkSPaisz5GaCUyhyryIKxTQajmw',
        ],
        'tbi7.cdek.ge' => [
            'yandex-verification' => 'c4747d0abe33b6e1',
            'google-site-verification' => 'FETZtrQHqP22gkqLXaJqKoSTioG8YbiOjp99ceLmngk',
        ],
        'bat3.cdek.ge' => [
            'yandex-verification' => '76e6e011e74797b3',
            'google-site-verification' => 'FETZtrQHqP22gkqLXaJqKoSTioG8YbiOjp99ceLmngk',
        ],
        'landing.local' => [
            'yandex-verification' => '76e6e011e74797b3',
            'google-site-verification' => 'FETZtrQHqP22gkqLXaJqKoSTioG8YbiOjp99ceLmngk',
        ],
    ];

    public static function tagName(): string
    {
        return 'meta';
    }

    public function create(Site $site, Page $page, Language $language): array
    {
        if (!array_key_exists($site->domain, self::AVAILABLE_DOMAIN_WITH_CONTENT)) {
            return [];
        }
        return $this->createTags($site->domain) ?? [];
    }

    private function createTags(string $domain): array
    {
        $tagContents = collect(self::AVAILABLE_DOMAIN_WITH_CONTENT[$domain]);
        return $tagContents->map(function (string $item, string $key) {
            $tagContent = collect([
                "meta",
                "name=\"{$key}\"",
                "content=\"{$item}\"",
            ])->join(' ');
            return $this->createTag($tagContent);
        })->values()->toArray();
    }

    private function createTag(string $tagContent): string
    {
        return "<{$tagContent}/>";
    }
}