<?php
namespace MercierCorentin\Nextcloud\Group;

use MercierCorentin\Nextcloud\Exceptions\XMLParseException;

/**
* class MercierCorentin\Nextcloud\Response
* statuses for nextcloud response
*/
abstract class Status
{

    /**
     * Search groups
     */
    const SEARCHGROUP_OK                = 100; // successful

    /**
     * Create groups
     */
    const CREATEGROUP_OK                = 100; // successful
    const CREATEGROUP_INVALID_INPUT     = 101; // invalid input data
    const CREATEGROUP_EXIST             = 102; // grou already exists
    const CREATEGROUP_UNKNOWN           = 103; // unknown error occurred whilst creatin group
    
    /**
     * Get group users
     */
    const GETGROUP_USERS_OK             = 100; // successful

    /**
     * Get group subadmins
     */
    const SUBADMINSGROUP_OK             = 100; // successful
    const SUBADMINSGROUP_EXIST          = 101; // group does not exist
    const SUBADMINSGROUP_UNKNOWN        = 102; // unknown failure

    /**
     * Delete Group
     */
    const DELETEGROUP_OK             = 100; // successful
    const DELETEGROUP_EXIST          = 101; // group does not exist
    const DELETEGROUP_UNKNOWN        = 102; // failed to delete group


}
