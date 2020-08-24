<?php
declare(strict_types=1);

namespace App\Controller;

use App\Reader\FileReaderInterface;
use App\Service\TreeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TreeController extends AbstractController
{
    /**
     * @var FileReaderInterface
     */
    protected $fileReader;

    /**
     * @var TreeService
     */
    protected $treeService;

    /**
     * @param FileReaderInterface $fileReader
     * @param TreeService $treeService
     */
    public function __construct(FileReaderInterface $fileReader, TreeService $treeService)
    {
        $this->fileReader = $fileReader;
        $this->treeService = $treeService;
    }

    /**
     * @Route("/tree", name="display_tree")
     */
    public function displayTree(): JsonResponse
    {
        $listFile = $this->fileReader->readFile(sprintf(
            '%s/%s/list.json',
            $this->getParameter('kernel.project_dir'),
            $this->getParameter('files_path')
        ));

        $treeFile = $this->fileReader->readFile(sprintf(
            '%s/%s/tree.json',
            $this->getParameter('kernel.project_dir'),
            $this->getParameter('files_path')
        ));

        $tree = json_decode($treeFile, true);
        $list = json_decode($listFile, true);

        $result = $this->treeService->appendNameToTree($tree, $list);

        return new JsonResponse($result);
    }
}

