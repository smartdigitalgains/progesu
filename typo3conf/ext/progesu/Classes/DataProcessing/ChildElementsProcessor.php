<?php

namespace SmartDigitalGains\Progesu\DataProcessing;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\FlexFormService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ChildElementsProcessor implements DataProcessorInterface
{
    /**
     * This function fetches the child elements and puts them into the specified field of the 'data' array of the element
     *
     * Source: https://stackoverflow.com/questions/40784705/irre-relations-from-tt-content-to-tt-content-in-fluid-styled-content
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }
        
        $table = $processorConfiguration['references.']['table'];
        $fieldName = $processorConfiguration['references.']['fieldName'];

        // Fetch child record uids
        // The records can then be rendered in the template e.g. by \MOKOM01\M01DqsSitePackage\ViewHelpers\ContentViewHelper
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $irreElements = $queryBuilder
            ->select('uid', 'pid', 't3ver_state')
            ->from($table)
            ->where($queryBuilder->expr()->eq($fieldName, $queryBuilder->createNamedParameter($cObj->data['uid'], \PDO::PARAM_INT)))
            ->orderBy('sorting')
            ->execute()
            ->fetchAll();


        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration);
        $processedData['data'][$targetVariableName] = $irreElements;

        return $processedData;
    }
}