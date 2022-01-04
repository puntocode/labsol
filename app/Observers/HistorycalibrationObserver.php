<?php

namespace App\Observers;

use App\Models\Patron;
use App\Models\Historycalibration;

class HistorycalibrationObserver
{
    /**
     * Handle the Historycalibration "created" event.
     *
     * @param  \App\Models\Historycalibration  $historyCalibration
     * @return void
     */
    public function created(Historycalibration $historyCalibration)
    {
        $patron = $historyCalibration->historycalibration;

        $lastCalibrationOutdated = is_null($patron->last_calibration)
            || $historyCalibration->calibration->isFuture($patron->last_calibration);

        if ($lastCalibrationOutdated && $patron instanceof Patron) {
            $patron->update([
                'last_calibration' => $historyCalibration->calibration,
                'next_calibration' => $historyCalibration->next_calibration,
            ]);
        }
    }

    /**
     * Handle the Historycalibration "updated" event.
     *
     * @param  \App\Models\Historycalibration  $historyCalibration
     * @return void
     */
    public function updated(Historycalibration $historyCalibration)
    {
        $patron = $historyCalibration->historycalibration;

        if ($patron instanceof Patron) {

            $lastCalibration = $patron->historycalibrations()->latest('calibration')->first();

            if ($patron->last_calibration != $lastCalibration->calibration && isset($patron->last_calibration)) {

                $patron->update([
                    'last_calibration' => $lastCalibration->calibration,
                    'next_calibration' => $lastCalibration->next_calibration,
                ]);
            }
        }
    }
}
