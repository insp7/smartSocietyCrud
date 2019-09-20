<?php

namespace App\Constants;

/**
 * Stores path for image directory for each and every entity.
 * Interface FileConstants
 * @package App\Constants
 */
interface FileConstants {

    // The path for all uploads
    const ATTACHMENTS_PATH = "/storage/attachments/";

    // News Feed Uploads Path
    const NEWS_FEED_ATTACHMENTS_PATH = FileConstants::ATTACHMENTS_PATH . "news-feed/";

    // Criminal Uploads Path
    const DATASET_ATTACHMENTS_PATH = FileConstants::ATTACHMENTS_PATH . "core/data-set/";
}

