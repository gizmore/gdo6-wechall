<?php
namespace GDO\WeChall\Method;
use GDO\Form\GDT_Form;
use GDO\Form\MethodForm;
use GDO\Mail\GDT_Email;
use GDO\DB\GDT_String;
use GDO\WeChall\GDT\WC_SiteSelect;
use GDO\Form\GDT_Submit;
use GDO\Form\GDT_AntiCSRF;
use GDO\User\GDO_User;
use GDO\WeChall\WC_Update;
use GDO\WeChall\WC_RegAt;
use GDO\Util\Common;
use GDO\WeChall\WC_Site;
use GDO\DB\GDT_Checkbox;
use GDO\Mail\Mail;
use GDO\UI\GDT_Link;
final class LinkSite extends MethodForm
{
    public function isGuestAllowed() { return false; }
    
    public function execute()
    {
        if ($token = Common::getGetString('wcxlinkxtoken'))
        {
            return $this->onLinkAfterMail(Common::getGetString('onsitename'), Common::getGetInt('site'), Common::getGetInt('hidden'), $token);
        }
        return parent::execute();
    }
    
    public function createForm(GDT_Form $form)
    {
        $user = GDO_User::current();
        $form->addFields(array(
            WC_SiteSelect::make('regat_site')->onlyLinkable()->required()->emptyInitial(t('choose_site_to_link')),
            GDT_String::make('regat_onsitename')->max(64)->initial($user->getName()),
            GDT_Email::make('onsitemail')->initial($user->getMail()),
            GDT_Checkbox::make('regat_hidename')->initial('0'),
            GDT_AntiCSRF::make(),
        ));
        $form->actions()->addField(GDT_Submit::make());
    }
    
    public function formValidated(GDT_Form $form)
    {
        $user = GDO_User::current();
        $site = $form->getFormValue('regat_site');
        $onsitename = $form->getFormVar('regat_onsitename');
        $onsitemail = $form->getFormVar('onsitemail');
        $hidden = $form->getFormVar('regat_hidename');
    
        /** @var $site \GDO\WeChall\WC_Site **/
        if (!WC_Update::combinationExists($site, $onsitename, $onsitemail))
        {
            return $this->error('err_combination_unknown', [$site->displayName()])->addField($this->renderPage());
        }
        
        if ($user->getMail() !== $onsitemail)
        {
            return $this->sendMail($user, $site, $onsitename, $onsitemail, (int)$hidden);
        }
        
        return $this->onLink($user, $site, $onsitename);
    }
    
    public function sendMail(GDO_User $user, WC_Site $site, $onsitename, $onsitemail, $hidden)
    {
        $sitename = $this->getSiteName();
        $siteName = $site->displayName();

        $append = "&site={$site->getID()}&onsitename={$onsitename}&hidden={$hidden}";
        $append .= '&wcxlinkxtoken='.WC_Update::getLinkToken($site, $onsitename);
        $link = GDT_Link::anchor(url('WeChall', 'LinkSite', $append));

        $mail = Mail::botMail();
        $mail->setReceiver($onsitemail);
        $mail->setReceiverName($onsitename);
        $mail->setSubject(t('mail_subj_wc_link', [$sitename, $siteName]));
        $mail->setBody(t('mail_body_wc_link', [$sitename, $onsitename, $siteName, $link, GDO_ADMIN_EMAIL]));
        $mail->sendAsText();
        
        return $this->message('msg_wc_link_site_mail');
    }
    
    public function onLinkAfterMail($onsitename, $siteid, $hidden, $token)
    {
        if (!($site = WC_Site::getById($siteid)))
        {
            return $this->error('err_site')->addField($this->renderPage());
        }
        
        if ($token !== WC_Update::getLinkToken($site, $onsitename, $hidden))
        {
            return $this->error('err_token')->addField($this->renderPage());
        }
        
        return $this->onLink(GDO_User::current(), $site, $onsitename, $hidden);
    }
    
    public function onLink(GDO_User $user, WC_Site $site, $onsitename, $hidden)
    {
        if (WC_RegAt::getFor($user, $site))
        {
            return $this->error('err_already_linked', [$site->displayName()])->addField($this->renderPage());
        }
        
        if (WC_RegAt::getByOnsitename($site, $onsitename))
        {
            return $this->error('err_onsitename_taken', [html($onsitename), $site->displayName()])->addField($this->renderPage());
        }
        
        $linkA = GDT_Link::anchor(href('WeChall', 'LinkedSites', "&update={$site->getID()}"), t('update_this_site'))->renderCell();
        $linkB = GDT_Link::anchor(href('WeChall', 'LinkedSites'), t('return_to_linked_sites'))->renderCell();
        
        return $this->message(t('msg_wc_linked_account', [html($site->displayName()), $linkA, $linkB]));
    }
}
