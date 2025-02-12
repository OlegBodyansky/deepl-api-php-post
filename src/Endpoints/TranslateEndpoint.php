<?php

namespace OlegBodyansky\DeepL\Api\Endpoints;

use OlegBodyansky\DeepL\Api\Resources\Translate;
use OlegBodyansky\DeepL\Api\Cons\Translate as TranslateType;

class TranslateEndpoint extends EndpointAbstract
{
    protected $resourcePath         = 'translate';
    protected $resourceCollectionKey = 'translations';

    protected function getResourceObject()
    {
        return new Translate($this->client);
    }

    /**
     * If true, validate that the length of a translation text
     * is not greater than self::MAX_TRANSLATION_TEXT_LEN
     *
     * @var bool
     */
    protected $validateTextLength = true;

    /**
     * Translate a text with DeepL.
     *
     * @param string $text
     * @param string $to
     * @param string $from
     * @param array  $options
     *
     * @return \OlegBodyansky\DeepL\Api\Resources\BaseResource|\OlegBodyansky\DeepL\Api\Resources\TranslateCollection
     * @throws \OlegBodyansky\DeepL\Api\Exceptions\ApiException
     */
    public function translate(
        $text,
        $to = TranslateType::LANG_EN,
        $from = TranslateType::LANG_AUTO,
        $options = [],
        $filters = []
    ) {
        $params = [
            'text'        => $text,
            'target_lang' => $to,
        ];

        if ($from !== TranslateType::LANG_AUTO) {
            $params['source_lang'] = $from;
        }

        return $this->getRequest(null, array_merge($options, $params),$filters, true);
    }
}
