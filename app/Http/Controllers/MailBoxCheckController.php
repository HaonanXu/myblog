<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use PhpImap\Mailbox as ImapMailbox;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;

Class MailBoxCheckController extends BaseController
{
    public function index(Request $request)
    {
        $mailbox = new ImapMailbox('{imap.gmail.com:993/imap/ssl}INBOX', '***@gmail.com', 'password', __DIR__);
        $mailsIds = collect($mailbox->searchMailbox('UNSEEN'));
        $mails = $mailsIds->map(function ($mailId) use ($mailbox) {
            dd($mailbox->getMail($mailId)->fromAddress);
            return $mailbox->getMail($mailId);
        });
    }
}