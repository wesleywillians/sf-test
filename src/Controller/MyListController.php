<?php

namespace App\Controller;

use App\Domain\MyList\ListItem;
use App\Domain\MyList\Movie;
use App\Domain\MyList\MyList;
use App\Domain\MyList\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyListController extends AbstractController
{
    /**
     * @Route("/mylist", name="my_list")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(MyList::class);
        return $this->json(
            $repository->findAll()
        );
    }

    /**
     * @Route("/mylist/add", name="my_list_add")
     */
    public function add()
    {
        $user = new User();
        $movie = new Movie("Homem aranha");
        $item = new ListItem($movie);
        $list = new MyList($user);
        $list->addToList($item);

        $em = $this->getDoctrine()->getManager();
        $em->persist($list);
        $em->flush();

        return $this->json([
            'message'=>true
        ]);
    }
}
