<?php

namespace Long\HideMe\Listener;


use Flarum\Api\Controller\ShowForumController;
use Flarum\Api\Event\WillGetData;
use Flarum\Api\Event\WillSerializeData;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Event\GetApiRelationship;
use Illuminate\Contracts\Events\Dispatcher;
use Long\HideMe\User\Anonymous;
use Symfony\Component\Translation\TranslatorInterface;

class AddForumUserRelationship
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * AddForumUserRelationship constructor.
     * @param $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }


    public function subscribe(Dispatcher $events)
    {
        $events->listen(GetApiRelationship::class, [$this, 'getApiRelationship']);
        $events->listen(WillSerializeData::class, [$this, 'loadUsersRelationship']);
        $events->listen(WillGetData::class, [$this, 'includeUserRelationship']);
    }

    public function getApiRelationship(GetApiRelationship $event)
    {
        if ($event->isRelationship(ForumSerializer::class, 'users')) {
            return $event->serializer->hasMany($event->model, UserSerializer::class, 'users');
        }
    }

    public function loadUsersRelationship(WillSerializeData $event)
    {
        if ($event->isController(ShowForumController::class)) {
            $event->data['users'] = [Anonymous::user($this->translator)];
        }
    }

    public function includeUserRelationship(WillGetData $event)
    {
        if ($event->isController(ShowForumController::class)) {
            $event->addInclude(['users']);
        }
    }
}
