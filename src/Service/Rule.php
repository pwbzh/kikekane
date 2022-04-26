<?php

namespace App\Service;

class Rule
{
    public function getBonus(int $year, array $bets, array $publicFigures): ?array
    {
        $firstDead = null;
        $lastDead = null;
        $solo = null;
        $duo = null;

        if ($bets) {
            foreach ($bets as $userId => $publicFiguresId) {
                if ($publicFiguresId) {
                    foreach ($publicFiguresId as $publicFigureId) {
                        if (isset($publicFigures[$publicFigureId])) {
                            $publicFigure = $publicFigures[$publicFigureId];

                            // Is dead this year?
                            if (!$publicFigure->getDeathDate() || ($publicFigure->getDeathDate() && $publicFigure->getDeathDate()->format('Y') != $year)) {
                                continue;
                            }

                            if (!$firstDead || $publicFigure->getDeathDate() < $firstDead->getDeathDate()) {
                                $firstDead = $publicFigure->getId();
                            }

                            if (!$lastDead || $publicFigure->getDeathDate() > $lastDead->getDeathDate()) {
                                $lastDead = $publicFigure->getId();
                            }
                        }
                    }
                }
            }
        }

        return array(
            'first_dead' => $firstDead,
            'last_dead' => $lastDead,
            'solo' => $solo,
            'duo' => $duo
        );
    }

    public function getResults(int $year, array $bets, array $publicFigures): ?array
    {
        $results = null;
        $bonus = $this->getBonus($year, $bets, $publicFigures);

        if ($bets) {
            foreach ($bets as $userId => $publicFiguresId) {
                $results[$userId] = 0;

                if ($publicFiguresId) {
                    foreach ($publicFiguresId as $publicFigureId) {
                        if (isset($publicFigures[$publicFigureId])) {
                            $publicFigure = $publicFigures[$publicFigureId];

                            // Is dead this year?
                            if (!$publicFigure->getDeathDate() || ($publicFigure->getDeathDate() && $publicFigure->getDeathDate()->format('Y') != $year)) {
                                continue;
                            }

                            // Points
                            $age = $publicFigure->getAge();

                            if ($age == 27) {
                                $results[$userId] += 27;
                            } elseif ($age <= 30) {
                                $results[$userId] += 20;
                            } elseif ($age >= 31 && $age <= 50) {
                                $results[$userId] += 16;
                            } elseif ($age >= 51 && $age <= 60) {
                                $results[$userId] += 13;
                            } elseif ($age >= 61 && $age <= 70) {
                                $results[$userId] += 12;
                            } elseif ($age >= 71 && $age <= 80) {
                                $results[$userId] += 11;
                            } elseif ($age >= 81 && $age <= 90) {
                                $results[$userId] += 10;
                            } elseif ($age >= 91) {
                                $results[$userId] += 9;
                            }

                            // Bonus
                            if ($bonus['first_dead'] == $publicFigureId) {
                                $results[$userId] += 5;
                            }

                            if ($bonus['last_dead'] == $publicFigureId) {
                                $results[$userId] += 5;
                            }
                        }
                    }
                }
            }
        }

        // Sort results
        if (is_array($results)) {
            krsort($results);
        }

        return $results;
    }
}
