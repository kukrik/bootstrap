<?php
/**
 *
 * Part of the QCubed PHP framework.
 *
 * @license MIT
 *
 */

namespace QCubed\Bootstrap;

use QCubed\QString;
use QCubed\Type;

/**
 * Class InputGroupTrait
 *
 * Adds input group functionality to a control. Specifically designed for \QCubed\Project\Control\TextBox controls and subclasses.
 *
 * @package QCubed\Bootstrap
 */
trait InputGroupTrait
{
    protected $strSizingClass;
    protected $strLeftText;
    protected $strRightText;
    protected $blnInputGroup = false;    // for subclasses

    /**
     * Wraps the give code with an input group tag.
     *
     * @param $strControlHtml
     * @return string
     */
    protected function wrapInputGroup($strControlHtml)
    {
        if ($this->strLeftText || $this->strRightText || $this->blnInputGroup) {
            $strControlHtml = sprintf('<div class="input-group %s">%s%s%s</div>',
                $this->strSizingClass,
                $this->getLeftHtml(),
                $strControlHtml,
                $this->getRightHtml()
            );
        }

        return $strControlHtml;
    }

    protected function getLeftHtml()
    {
        if ($this->strLeftText) {
            return sprintf('<span class="input-group-addon">%s</span>', QString::htmlEntities($this->strLeftText));
        }
        return '';
    }

    protected function getRightHtml()
    {
        if ($this->strRightText) {
            return sprintf('<span class="input-group-addon">%s</span>', QString::htmlEntities($this->strRightText));
        }
        return '';
    }

    protected function sizingClass()
    {
        return $this->strSizingClass;
    }

    protected function leftText()
    {
        return $this->strLeftText;
    }

    protected function rightText()
    {
        return $this->strRightText;
    }

    abstract public function markAsModified();

    protected function setSizingClass($strSizingClass)
    {
        $strSizingClass = Type::cast($strSizingClass, Type::STRING);
        if ($strSizingClass != $this->strSizingClass) {
            $this->markAsModified();
            $this->strSizingClass = $strSizingClass;
        }
    }

    protected function setLeftText($strLeftText)
    {
        $strText = Type::cast($strLeftText, Type::STRING);
        if ($strText != $this->strLeftText) {
            $this->markAsModified();
            $this->strLeftText = $strText;
        }
    }

    protected function setRightText($strRightText)
    {
        $strText = Type::cast($strRightText, Type::STRING);
        if ($strText != $this->strRightText) {
            $this->markAsModified();
            $this->strRightText = $strText;
        }
    }
}
