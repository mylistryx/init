<?php

declare(strict_types=1);

namespace frontend\models\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $subject = null;
    public ?string $body = null;
    public ?string $verifyCode = null;


    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'name'       => 'Name',
            'email'      => 'Email',
            'subject'    => 'Subject',
            'body'       => 'Body',
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail(string $email): bool
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
