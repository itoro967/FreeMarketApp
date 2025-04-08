<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TradeCompleted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $item;
    public $to_user_name;
    public function __construct($item,$to_user_name)
    {
        $this->item = $item;
        $this->to_user_name = $to_user_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('取引完了のお知らせ【'.$this->item->name.'】')
            ->greeting('取引完了のお知らせ【'.$this->item->name.'】')
            ->line($this->to_user_name.'さんとの取引「'.$this->item->name.'」が完了しました。')
            ->line($this->to_user_name.'さんの評価を行ってください')
            ->action('取引ページへ', route('tradingMessage.chat', ['item_id' => $this->item->id]))
            ->line('取引メッセージを確認するには、上記のリンクをクリックしてください。')
            ->line('ご利用ありがとうございました。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
