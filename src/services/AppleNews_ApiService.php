<?php
namespace craft\applenews\services;

use ChapterThree\AppleNewsAPI\PublisherAPI;
use Craft;
use craft\applenews\Plugin;
use yii\base\Component;


/**
 * Class AppleNews_ApiService
 *
 * @license https://github.com/pixelandtonic/AppleNews/blob/master/LICENSE
 *
 * @property \craft\applenews\services\AppleNewsService $service
 */
class AppleNews_ApiService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Returns information about a channel.
     *
     * @param string $channelId
     *
     * @return \stdClass
     */
    public function readChannel($channelId): \stdClass
    {
        return $this->get($channelId, '/channels/{channel_id}', ['channel_id' => $channelId]);
    }

    /**
     * Returns information about a channel’s sections.
     *
     * @param string $channelId
     *
     * @return \stdClass[]
     */
    public function listSections($channelId): array
    {
        return $this->get($channelId, '/channels/{channel_id}/sections', ['channel_id' => $channelId]);
    }

    /**
     * Returns information about a section.
     *
     * @param string $channelId
     * @param string $sectionId
     *
     * @return \stdClass
     */
    public function readSection($channelId, $sectionId): \stdClass
    {
        return $this->get($channelId, '/sections/{section_id}', ['section_id' => $sectionId]);
    }

    /**
     * Returns information about an article.
     *
     * @param string $channelId
     * @param string $articleId
     *
     * @return \stdClass
     */
    public function readArticle($channelId, $articleId): \stdClass
    {
        return $this->get($channelId, '/articles/{article_id}', ['article_id' => $articleId]);
    }

    /**
     * Searches for articles in a channel.
     *
     * @param string $channelId
     * @param array  $params
     *
     * @return \stdClass[]
     */
    public function searchArticles($channelId, array $params = []): array
    {
        return $this->get($channelId, '/channels/{channel_id}/articles', ['channel_id' => $channelId], $params);
    }

    /**
     * Creates a new article.
     *
     * @param string $channelId
     * @param array  $data
     *
     * @return \stdClass
     */
    public function createArticle($channelId, $data): \stdClass
    {
        return $this->post($channelId, '/channels/{channel_id}/articles', ['channel_id' => $channelId], $data);
    }

    /**
     * Updates an article.
     *
     * @param string $channelId
     * @param string $articleId
     * @param array  $data
     *
     * @return \stdClass
     */
    public function updateArticle($channelId, $articleId, $data): \stdClass
    {
        return $this->post($channelId, '/articles/{article_id}', ['article_id' => $articleId], $data);
    }

    /**
     * Deletes an article.
     *
     * @param string $channelId
     * @param string $articleId
     *
     * @return \stdClass
     */
    public function deleteArticle($channelId, $articleId): \stdClass
    {
        return $this->delete($channelId, '/articles/{article_id}', ['article_id' => $articleId]);
    }

    // Protected Methods
    // =========================================================================

    /**
     * Sends a GET request to the Apple News API.
     *
     * @param string $channelId
     * @param string $path
     * @param array  $pathArgs
     * @param array  $data
     *
     * @return mixed
     */
    protected function get($channelId, $path, array $pathArgs = [], array $data = [])
    {
        $api = $this->getApi($channelId);
        $response = $api->get($path, $pathArgs, $data);

        return $response;
    }

    /**
     * Sends a POST request to the Apple News API.
     *
     * @param string $channelId
     * @param string $path
     * @param array  $pathArgs
     * @param array  $data
     *
     * @return mixed
     */
    protected function post($channelId, $path, array $pathArgs = [], array $data = [])
    {
        $api = $this->getApi($channelId);
        $response = $api->post($path, $pathArgs, $data);

        return $response;
    }

    /**
     * Sends a DELETE request to the Apple News API.
     *
     * @param string $channelId
     * @param string $path
     * @param array  $pathArgs
     * @param array  $data
     *
     * @return mixed
     */
    protected function delete($channelId, $path, array $pathArgs = [], array $data = [])
    {
        $api = $this->getApi($channelId);
        $response = $api->delete($path, $pathArgs, $data);

        return $response;
    }

    /**
     * Returns a publisher API configured for a given channel ID.
     *
     * @param string $channelId
     *
     * @return PublisherAPI
     */
    protected function getApi($channelId): PublisherAPI
    {
        $channel = $this->getService()->getChannelById($channelId);
        $api = new PublisherAPI($channel->getApiKeyId(), $channel->getApiSecret(), 'https://news-api.apple.com');

        return $api;
    }

    /**
     * Returns the AppleNewsService instance
     *
     * @return AppleNewsService
     */
    protected function getService(): AppleNewsService
    {
        return Plugin::getInstance()->appleNewsService;
    }
}
