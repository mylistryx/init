<?php

declare(strict_types=1);

namespace frontend\tests\unit\models\forms;

use Codeception\Test\Unit;
use frontend\models\forms\ContactForm;
use frontend\tests\UnitTester;
use yii\mail\MessageInterface;

class ContactFormTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    public function testSendEmail(): void
    {
        $model = new ContactForm();

        $model->attributes = [
            'name'    => 'Tester',
            'email'   => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body'    => 'body of current message',
        ];

        expect($model->sendEmail('admin@example.com'))->notToBeEmpty();

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        /** @var MessageInterface $emailMessage */
        $emailMessage = $this->tester->grabLastSentEmail();
        expect($emailMessage)->toBeInstanceOf(MessageInterface::class, 'valid email is sent');
        expect($emailMessage->getTo())->arrayToHaveKey('admin@example.com');
        expect($emailMessage->getFrom())->arrayToHaveKey('noreply@example.com');
        expect($emailMessage->getReplyTo())->arrayToHaveKey('tester@example.com');
        expect($emailMessage->getSubject())->stringToContainString('very important letter subject');
        expect($emailMessage->toString())->stringToContainString('body of current message');
    }
}
