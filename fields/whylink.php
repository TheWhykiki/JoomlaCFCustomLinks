<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Osmap
 *
 * @copyright   Copyright (C) 2017 NAME. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('text');

class JFormFieldWhylink extends JFormFieldText
{
    public $type = 'Whylink';




    public function getInput()
    {

        $field       = '<div class="linkFieldContainer">';
        $field      .= $this->_setModalFile($this->id);
        $field      .= $this->_setModalArticles($this->id);
        $field      .= $this->_setModalMenuitems($this->id);
        $field      .= $this->_setContactItems($this->id);
        $field      .=   '<input type="text" name="' .  $this->name . '" id="' . $this->id . '" value="' . $this->value. '" />';
        $field      .=  '<a href="#menuModal" role="button" class="btn btn-info btnWhylink" id="menuModalBtn" data-toggle="modal"><span class="icon-link large-icon"> </span></a>';
        $field      .=  '<a href="#fileModal" role="button" class="btn btn-info btnWhylink" id="fileModalBtn" data-toggle="modal"><span class="icon-file large-icon"> </span></a>';
        $field      .=  '<a href="#articlesModal" role="button" class="btn btn-info btnWhylink" id="articlesModalBtn" data-toggle="modal"><span class="icon-list large-icon"> </span></a>';
        $field      .=  '<a href="#contactModal" role="button" class="btn btn-info btnWhylink" id="contactModalBtn" data-toggle="modal"><span class="icon-user large-icon"> </span></a>';
        $field      .=   '</div>';

       return $field;
    }

    protected function _setModalFile($dataAttribute){

        $html = '<div id="fileModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">';
        $html .= '<div class="modal-header">';
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            $html .= '<h3 id="fileModalLabel">' . Text::_('WHYLINK_FILEHEADLINE') . '</h3>';
        $html .= '</div>';
        $html .= '<div class="modal-body" data-fieldid="' . $dataAttribute . '">';
        $html .= '</div>';
        $html .= '<div class="modal-footer">';
            $html .= '<button class="btn" data-dismiss="modal" aria-hidden="true">' . Text::_('WHYLINK_CLOSE') . '</button>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    protected function _setModalArticles($dataAttribute){
        $token = Session::getFormToken();

        $html = '<div id="articlesModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="articlesModalLabel" aria-hidden="true">';
        $html .= '<div class="modal-header">';
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            $html .= '<h3 id="articlesModalLabel">' . Text::_('WHYLINK_ARTICLEHEADLINE') . '</h3>';
        $html .= '</div>';
        $html .= '<div class="modal-body" data-fieldid="' . $dataAttribute . '" data-link="index.php?layout=modal&tmpl=component&' . $token . '=1&option=com_content&view=articles">';
            $html .= '<iframe id="articlesFrame" src="index.php?layout=modal&tmpl=component&' . $token . '=1&option=com_content&view=articles"></iframe>';
        $html .= '</div>';
        $html .= '<div class="modal-footer">';
            $html .= '<button class="btn" data-dismiss="modal" aria-hidden="true">' . Text::_('WHYLINK_CLOSE') . '</button>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    protected function _setModalMenuitems($dataAttribute){
        $token = Session::getFormToken();

        $html = '<div id="menuModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">';
        $html .= '<div class="modal-header">';
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            $html .= '<h3 id="menuModalLabel">' . Text::_('WHYLINK_MENUHEADLINE') . '</h3>';
        $html .= '</div>';
        $html .= '<div class="modal-body" data-fieldid="' . $dataAttribute . '" data-link="index.php?layout=modal&tmpl=component&' . $token . '=1&option=com_menus&view=items">';
            $html .= '<iframe id="menuFrame" src="index.php?layout=modal&tmpl=component&' . $token . '=1&option=com_menus&view=items"></iframe>';
        $html .= '</div>';
        $html .= '<div class="modal-footer">';
            $html .= '<button class="btn" data-dismiss="modal" aria-hidden="true">' . Text::_('WHYLINK_CLOSE') . '</button>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    protected function _setContactItems($dataAttribute){
        $token = Session::getFormToken();

        $html = '<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">';
        $html .= '<div class="modal-header">';
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
            $html .= '<h3 id="contactModalLabel">' . Text::_('WHYLINK_contactHEADLINE') . '</h3>';
        $html .= '</div>';
        $html .= '<div class="modal-body" data-fieldid="' . $dataAttribute . '" data-link="index.php?layout=modal&tmpl=component&' . $token . '=1&option=com_contact&view=contacts">';
            $html .= '<iframe id="contactFrame" src="index.php?layout=modal&tmpl=component&' . $token . '=1&option=com_contact&view=contacts"></iframe>';
        $html .= '</div>';
        $html .= '<div class="modal-footer">';
            $html .= '<button class="btn" data-dismiss="modal" aria-hidden="true">' . Text::_('WHYLINK_CLOSE') . '</button>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
