<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Text
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\Folder;

defined('_JEXEC') or die;

JLoader::import('components.com_fields.libraries.fieldsplugin', JPATH_ADMINISTRATOR);

/**
 * Fields Text Plugin
 *
 * @since  3.7.0
 */
class PlgFieldsWhylink extends FieldsPlugin
{
    public function onBeforeCompileHead()
    {
        $doc = Factory::getDocument();
        $doc->addStyleSheet('../plugins/fields/whylink/assets/whylink.css');
        $doc->addScript('../plugins/fields/whylink/assets/linkfield.js');
    }

    public static function onAjaxWhylink()
    {
        // Create a new query object.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->select($db->quoteName(array('title', 'introtext', 'fulltext')))
            ->from($db->quoteName('#__content'))
            ->order($db->quoteName('modified') . ' ASC');

        $db->setQuery($query, 0, $this->params->get('limit', 5));

        return $db->loadObjectList();
    }


    public static function onAjaxWhylinkGetFiles()
    {
        $folders = Folder::listFolderTree(JPATH_SITE . '/images', '');
        $filesArray = [];

        $html    = '';
        $html   .= '<div class="why-file-tree">';
        foreach($folders as $folder)
        {
            $filesArray[] = [
                'name'  =>  $folder['name'],
                'path'  =>  $folder['fullname'],
                'files' =>  Folder::files($folder['fullname'])
            ];

            $files = Folder::files($folder['fullname']);

            $filePath = substr($folder['fullname'], strpos($folder['fullname'], '/images'));

            $html   .= '<label class="why-file-tree-item level1">';
            $html   .=      '<input class="why-file-tree-cb" type="checkbox">';
            $html   .=      '<span class="why-file-tree-label">' . $folder['name'] . '</span>';
            $html   .=          '<div class="why-file-tree-branches">';

            foreach($files as $file)
            {
                $html   .=              '<label class="why-file-tree-item file">';
                $html   .=                  '<input class="why-file-tree-cb" type="checkbox">';
                $html   .=                  '<span class="why-file-tree-label" data-filepath="' . $filePath . '/' . $file . '">' . $file . '</span>';
                $html   .=              '</label>';
            }
            $html   .=          '</div>';
            $html   .= '</label>';
        }
        $html .= '</div>';
        return $html;
    }
}
