<?php
namespace craft\applenews;

use craft\elements\Asset;


/**
 * Interface IAppleNewsArticle
 *
 * @license https://github.com/pixelandtonic/AppleNews/blob/master/LICENSE
 *
 * @see     https://developer.apple.com/library/ios/documentation/General/Conceptual/News_API_Ref/CreateArticle.html#//apple_ref/doc/uid/TP40015409-CH14-SW1
 */
interface AppleNewsArticleInterface
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the article content, described in Apple News Format.
     *
     * This will become the "article.json" part of the publish request.
     *
     * @return array The article content
     */
    public function getContent(): array;

    /**
     * Returns the files that are included in the article.
     *
     * This should be set to an array where the keys are the file URIs within the publish request
     * (everything after "bundle://") and the values are either strings (local path to the file)
     * or {@link Asset}s.
     *
     * @return string[]|Asset[]|null The files that are included in the article
     */
    public function getFiles(): array;

    /**
     * Returns metadata about the article.
     *
     * This will become the "metadata" part of the publish request.
     *
     * @return array|null Metadata about the article
     */
    public function getMetadata(): array;
}
