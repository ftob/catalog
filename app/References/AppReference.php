<?php
namespace App\References;

/**
 * Application reference
 * @example app()->environment() === AppReference::ENV_PRODUCTION
 * Class AppReference
 * @package App\References
 */
class AppReference
{
    const ENV_PRODUCTION = 'production';
    const ENV_DEV = 'development';
    const ENV_STAGE = 'stage';
}