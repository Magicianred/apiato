<?php

namespace App\Containers\Settings\Tasks;

use App\Containers\Settings\Data\Repositories\SettingRepository;
use App\Containers\Settings\Exceptions\SettingNotFoundException;
use App\Ship\Parents\Tasks\Task;

/**
 * Class FindSettingsByKeyTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindSettingByKeyTask extends Task
{

    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * FindSettingsByKeyTask constructor.
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $key
     *
     * @return mixed
     * @throws SettingNotFoundException
     */
    public function run($key)
    {
        $result = $this->repository->findWhere(['key' => $key])->first();

        if(!$result) {
            throw new SettingNotFoundException();
        }

        return $result->value;
    }
}