<?php

namespace App\Manager;

use App\Entity\Post;
use Exception;


class PostManager extends BaseManager
{

    /**
     * @return array
     */
        public function getAllPosts()
        {
            $stmt = $this->db->prepare('SELECT * FROM posts');
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                $posts_array = [];
                $posts_array["posts"] = [];
    
                while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
                {
                    extract($row);
    
                    $data = [
                        "id" => $id,
                        "title" => $title,
                        "content" => $content
                    ];
    
                    $posts_array["posts"][] = $data;
                }
    
                http_response_code(200);
                print_r(json_encode($posts_array));
    
            }
        }

        public function getPostById(int $id)
        {

            $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->execute(
                array(
                    ":id"=> $id
                )
            );
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        }

    public function getPostByUser(string $token): array
    {
        try {


            $sql = "SELECT firstName, lastName, title, content FROM posts p JOIN user u ON (p.user_id = u.user_id) WHERE u.token = :token";
            $stmt = $this->db->prepare($sql);
//                $query->bindValue(':id', PDO::PARAM_STR);
            $stmt->execute(array(
                ':token'=> $token
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }



    /**
     * @param Post $post
     * @param $id
     * @return bool
     */
        public function createPost(Post $post):bool
        {
            $stmt  = "INSERT INTO post (title, content, user_id) VALUES (:title, :content, :user_id)";
            $create = $this->db->prepare($stmt);
            $create->execute(array(
                'title'=>$post->getTitle(),
                'content'=>$post->getContent(),
                'user_id'=>$post->getUserId(),
                
            ));
            return true;
        }


    /**
     * @param Post $post
     * @return bool
     */

        public function update(Post $post): bool
        {
            $stmt = "UPDATE post SET (title =:title) WHERE id=:id";
            $query = $this->db->prepare($stmt);
            $query->execute(
                array(
                    "id"=> $post->getId(),
                    "title"=> $post->getTitle()
                )
            );

            return true;
        }

        /**
         * @param Post $post
         * @return bool
         */

        public function updateContent(string $content, $id): bool
        {

            $stmt = "UPDATE post SET content =:content WHERE id=:id";
            $query = $this->db->prepare($stmt);



            $query->execute(
                array(
                    "content" => $content,
                    "id" => $id
                )
            );

            return true;
        }

        public function updateTitle(string $title, int $id): bool
        {

            $stmt = "UPDATE post SET title =:title WHERE id=:id";
            $query = $this->db->prepare($stmt);

            $query->execute(
                array(
                    "title" => $title,
                    "id" => $id
                )
            );

            return true;
        }



    /**
         * @param int $id
         * @return bool
         */
        public function deletePostById(int $id):bool
        {
            $stmt2 = "DELETE FROM comments WHERE id = :id";
            $delete2 = $this->db->prepare($stmt2);
            $delete2->execute(array(
                ':id' => $id
            ));

            $stmt = "DELETE FROM posts WHERE id = :id";
            $delete = $this->db->prepare($stmt);
            $delete->execute(array(
                'id'=> $id
            ));
            return true;
        }

    public function getUserId($id)
    {
        $stmt = "SELECT user_id FROM posts WHERE id = :id";
        $select = $this->db->prepare($stmt);
        $select->execute(array(
            'id'=> $id
        ));
        return $select->fetch(\PDO::FETCH_ASSOC);
    }
}