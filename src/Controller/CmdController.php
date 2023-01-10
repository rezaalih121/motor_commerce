<?php

namespace App\Controller;

use App\Entity\Cmd;
use App\Form\CmdType;
use App\Repository\CmdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cmd')]
class CmdController extends AbstractController
{
    #[Route('/', name: 'app_cmd_index', methods: ['GET'])]
    public function index(CmdRepository $cmdRepository): Response
    {
        return $this->render('cmd/index.html.twig', [
            'cmds' => $cmdRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cmd_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CmdRepository $cmdRepository): Response
    {
        $cmd = new Cmd();
        $form = $this->createForm(CmdType::class, $cmd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cmdRepository->save($cmd, true);

            return $this->redirectToRoute('app_cmd_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cmd/new.html.twig', [
            'cmd' => $cmd,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cmd_show', methods: ['GET'])]
    public function show(Cmd $cmd): Response
    {
        return $this->render('cmd/show.html.twig', [
            'cmd' => $cmd,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cmd_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cmd $cmd, CmdRepository $cmdRepository): Response
    {
        $form = $this->createForm(CmdType::class, $cmd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cmdRepository->save($cmd, true);

            return $this->redirectToRoute('app_cmd_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cmd/edit.html.twig', [
            'cmd' => $cmd,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cmd_delete', methods: ['POST'])]
    public function delete(Request $request, Cmd $cmd, CmdRepository $cmdRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cmd->getId(), $request->request->get('_token'))) {
            $cmdRepository->remove($cmd, true);
        }

        return $this->redirectToRoute('app_cmd_index', [], Response::HTTP_SEE_OTHER);
    }
}