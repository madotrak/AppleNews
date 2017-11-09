<?php

namespace craft\applenews\records;

use craft\db\ActiveRecord;
use yii\db\ActiveQueryInterface;
use craft\elements\Entry;

/**
 * Class AppleNews_ArticleQueueRecord record.
 *
 * @property \Locale $locale     Locale
 * @property string    $channelId  Channel ID
 * @property int $entryId      Entry ID
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class AppleNews_ArticleQueueRecord extends ActiveRecord
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     *
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%applenews_articlequeue}}';
    }

    /**
     * Returns the entry’s entry.
     *
     * @return ActiveQueryInterface The relational query object.
     */
    public function getEntry(): ActiveQueryInterface
    {
        return $this->hasOne(Entry::class,['id' => 'entryId']);
    }

}