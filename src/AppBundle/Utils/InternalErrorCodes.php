<?php
/**
 * Created by PhpStorm.
 * User: sedona
 * Date: 11/06/2015
 * Time: 16:18
 */

namespace AppBundle\Utils;

/**
 * List of API status codes.
 *
 * @author Bernard Thomas <bernard.thomas@diapason-info.com>
 */
final class InternalErrorCodes
{

    const FORM_ERROR = 'form-error';
    const USER_DOESNT_EXISTS = 'user-no-exist';
    const ARTICLE_DOESNT_EXISTS = 'article-no-exist';
    const EMAIL_EXISTS = 'email-exists';
}