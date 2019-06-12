<?php
namespace MercierCorentin\Nextcloud\User;

use MercierCorentin\Nextcloud\Exceptions\XMLParseException;

/**
* class MercierCorentin\Nextcloud\Response
* statuses for nextcloud response
*/
abstract class Status
{



    /**
     * User create endpoint
     */
    const CREATEUSER_OK                     = 100; // successful
    const CREATEUSER_INVALID_INPUT          = 101; // invalid input data
    const CREATEUSER_EXIST                  = 102; // username already exists
    const CREATEUSER_UNKNOWN                = 103; // unknown error occurred whilst adding the user
    const CREATEUSER_GROUP_NOT_EXIST        = 104; // group does not exist
    const CREATEUSER_NO_PRIVILEGES_ERROR    = 105; // insufficient privileges for group
    const CREATEUSER_NO_GROUP_SPECIFIED     = 106; // no group specified (required for subadmins)
    const CREATEUSER_EASY_PASSWORD          = 107; // all errors that contain a hint - for example “Password is among the 1,000,000 most common ones. Please make it unique.” (this code was added in 12.0.6 & 13.0.1)
    const CREATEUSER_NO_PASSWORD_NO_MAIL    = 108; // password and email empty. Must set password or an email
    const CREATEUSER_EMAIL_NOT_SEND         = 109; // invitation email cannot be send

    /**
     * User list endpoint
     */
    const USERLIST_OK               = 100; // successful
    
    /**
     * Get user infos
     */
    const USERINFOS_OK              = 100; // successful
    const USERINFOS_NOT_FOUND       = 404; // not found
    /**
     * User edit endpoint
     */
    const EDITUSER_OK               = 100; // successful
    const EDITUSER_NOT_EXIST        = 101; // user not found
    const EDITUSER_INVALID_INPUT    = 102; // invalid input data

    /**
     * User disable endpoint
     */
    const DISABLEUSER_OK            = 100; // successful
    const DISABLEUSER_FAILURE       = 101; // failure

    /**
     * User enable endpoint
     */
    const ENABLEUSER_OK             = 100; // successful
    const ENABLEUSER_FAILURE        = 101; // failure

    /**
     * User delete endpoint
     */
    const DELETEUSER_OK             = 100; // successful
    const DELETEUSER_FAILURE        = 101; // failure

    /**
     * Get user's groups
     */
    const GETUSER_GROUP_OK           = 100; // successful

    /** 
     * Add user to a group
     */
    const ADDUSER_TO_GROUP_OK                   = 100; // successful
    const ADDUSER_TO_GROUP_NOGROUP              = 101; // no group specified
    const ADDUSER_TO_GROUP_EXIST_GROUP          = 102; // group does not exist
    const ADDUSER_TO_GROUP_EXIST_USER           = 103; // user does not exist
    const ADDUSER_TO_GROUP_PRIVILEGES           = 104; // insufficient privileges
    const ADDUSER_TO_GROUP_FAIL                 = 105; // failed to add user to group

    /** 
     * Delete user to a group
     */
    const DELETEUSER_FROM_GROUP_OK              = 100; // successful
    const DELETEUSER_FROM_GROUP_NOGROUP         = 101; // no group specified
    const DELETEUSER_FROM_GROUP_EXIST_GROUP     = 102; // group does not exist
    const DELETEUSER_FROM_GROUP_EXIST_USER      = 103; // user does not exist
    const DELETEUSER_FROM_GROUP_PRIVILEGES      = 104; // insufficient privileges
    const DELETEUSER_FROM_GROUP_FAIL            = 105; // failed to delete user to group

    /**
     * Promote user to subadmin
     */
    const PROMOTEUSER_TO_SUBADMIN_OK            = 100; // successful
    const PROMOTEUSER_TO_SUBADMIN_EXIST_USER    = 101; // user does not exist
    const PROMOTEUSER_TO_SUBADMIN_EXIST_GROUP   = 102; // group does not exist
    const PROMOTEUSER_TO_SUBADMIN_UNKNOW        = 103; // unknown failure
    
    /**
     * Demote user to subadmin
     */
    const DEMOTEUSER_TO_SUBADMIN_OK             = 100; // successful
    const DEMOTEUSER_TO_SUBADMIN_EXIST_USER     = 101; // user does not exist
    const DEMOTEUSER_TO_SUBADMIN_EXIST_GROUP    = 102; // user is not a subadmin of the group / group does not exist
    const DEMOTEUSER_TO_SUBADMIN_UNKNOW         = 103; // unknown failure

    /**
     * Get user's subadmin groups
     */
    const GETUSER_SUBADMIN_GROUPS_OK            = 100; // successful
    const GETUSER_SUBADMIN_GROUPS_EXIST         = 101; // user does not exist
    const GETUSER_SUBADMIN_GROUPS_UNKNOW        = 102; // unknown failure
    /**
     * User resend Welcome email endpoint
     */
    const WELCOME_OK                = 100;
    const WELCOME_INVALID_MAIL      = 101;
    const WELCOME_SEND_FAILED       = 102;

    /**
     * errors
     */
    const ERROR_AUTH                = 997; // bad userid/password data. permission deny.


}
