<?php


namespace Long\HideMe\Listener;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Api\Serializer\PostSerializer;
use Flarum\Discussion\Discussion;
use Flarum\Post\CommentPost;
use Flarum\Post\Post;
use Long\HideMe\HideMe;
use Long\HideMe\User\Anonymous;
use Symfony\Component\Translation\TranslatorInterface;

class SerializingListener
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * SerializingListener constructor.
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function handle(Serializing $event)
    {
        if ($event->serializer instanceof DiscussionSerializer
            || $event->serializer instanceof BasicPostSerializer
            || $event->serializer instanceof PostSerializer) {
            if ($event->actor->can('dotronglong-hide-me.see_author')) {
                return; // no hidden
            }
            $this->hide($event);
        }
    }

    private function hide(Serializing $event)
    {
        $anonymous = Anonymous::user($this->translator);
        if ($event->model instanceof Discussion) {
            $lastPost = $event->model->lastPost()->first();
            if ($lastPost[HideMe::COL_HIDE_ME] === HideMe::ANONYMOUS) {
                $event->model->setRelation('lastPostedUser', $anonymous);
            }
            if ($event->model[HideMe::COL_HIDE_ME] === HideMe::ANONYMOUS) {
                $event->model->setRelation('user', $anonymous);
            }
        } else if (($event->model instanceof Post || $event->model instanceof CommentPost)
            && $event->model[HideMe::COL_HIDE_ME] === HideMe::ANONYMOUS) {
            $event->model->setRelation('user', $anonymous);
        }
    }
}
