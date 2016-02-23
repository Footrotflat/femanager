<?php
namespace In2code\Femanager\Utility;

use In2code\Femanager\Domain\Model\Log;
use In2code\Femanager\Domain\Model\User;
use In2code\Femanager\Domain\Repository\LogRepository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 in2code.de
 *  Alex Kellner <alexander.kellner@in2code.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class LogUtility
 *
 * @package In2code\Femanager\Utility
 */
class LogUtility extends AbstractUtility
{

    /**
     * @param int $state State to log
     * @param User $user Related User
     * @return void
     */
    public static function log($state, User $user)
    {
        if (!ConfigurationUtility::isDisableLogActive()) {
            $log = self::getLog();
            $log->setTitle(LocalizationUtility::translate('tx_femanager_domain_model_log.state.' . $state));
            $log->setState($state);
            $log->setUser($user);
            self::getLogRepository()->add($log);
        }
    }

    /**
     * @return Log
     */
    protected function getLog()
    {
        return self::getObjectManager()->get(Log::class);
    }

    /**
     * @return LogRepository
     */
    protected function getLogRepository()
    {
        return self::getObjectManager()->get(LogRepository::class);
    }
}
