<?php
namespace GDO\WeChall\GDT;
use GDO\Form\GDT_Form;
use GDO\Login\Method\Form;
/**
 * Take login form method fields for sidebar login form.
 * @author gizmore
 */
final class WC_SideLogin extends GDT_Form
{
    public function __construct()
    {
        $this->addFields(Form::make()->getForm()->getFields());
    }
}
