<?php

require_once __DIR__ . '/../../../bootstrap.php';

$entityManager = getEntityManager();

$resultRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');
$results = $resultRepository->findAll();

if (in_array('--json', $argv)) {
    echo json_encode($results, JSON_PRETTY_PRINT);
} else {
    $items = 0;
    echo PHP_EOL . sprintf("  %2d: %20s %30s %20s\n", 'Id', 'Username:', 'Result:', 'Date:');
    /** @var \MiW16\Results\Entity\Result $result */
    foreach ($results as $result) {
        echo sprintf(
            '- %2d: %20s %30s %20s',
            $result->getId(),
            $result->getUser()->getUsername(),
            $result->getResult(),
            $result->getTime()->format('d/m/Y')
        ),
        PHP_EOL;
        $items++;
    }

    echo "\nTotal: $items users.\n\n";
}
