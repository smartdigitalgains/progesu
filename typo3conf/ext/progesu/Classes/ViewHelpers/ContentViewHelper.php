<?php
namespace SmartDigitalGains\Progesu\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class ContentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Parse content element and return HTML
     *
     * Source: http://blog.teamgeist-medien.de/2014/01/extbase-fluid-viewhelper-fuer-tt_content-elemente-mit-namespaces.html
     *
     * @param    int           UID des Content Element
     * @return   string        Geparstes Content Element
     */

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('uid', 'int', 'the unique id of the content element', true, NULL);
    }

    public function render()
    {

        $conf = [
            'tables' => 'tt_content',
            'source' => $this->arguments['uid'],
            'dontCheckPid' => 1
        ];

        $html = $GLOBALS['TSFE']->cObj->cObjGetSingle('RECORDS', $conf);

        return $html;

    }
}
