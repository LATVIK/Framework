<?php

namespace api\controllers;

use controllers\BaseController;
use models\Post;
use service\Exception\AccessDeniedException;
use service\Exception\NoFoundException;
use service\Exception\UnauthorizedException;

class PostController extends BaseController
{
    /**
     * @throws AccessDeniedException
     * @throws UnauthorizedException
     * @throws NoFoundException
     */
    public function deleteAction()
    {
        $postId = getallheaders()['post_id'];

        if (!$this->user) {
            throw new UnauthorizedException();
        }

        $post = Post::findById($postId);

        if (!$post) {
            throw new NoFoundException('Post is not found');
        }

        if ($post->getAuthorId() != $this->user->getId()) {
            throw new AccessDeniedException('Only the creator can delete a post');
        }

        $post->delete();

        return null;
    }
}
