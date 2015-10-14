<?php

    require_once '../controller/CursoController.php';
    require_once '../controller/TutorController.php';
    require_once '../controller/DisciplinaController.php';
    require_once("../lib/raelgc/view/Template.php");
    use raelgc\view\Template;

    $tpl = new Template("../view/editaDisciplina.html");
    
    $disciplinaController = new DisciplinaController();
    $cursoController = new CursoController();
    $tutorController = new TutorController();
    
    $disciplina = $disciplinaController->getById($_GET['id']);
    
    $tpl->NOME_DISCIPLINA = $disciplina->getNome();
    
    $cursos = $cursoController->read();
    $tutors = $tutorController->read();
    
    foreach($cursos as $t){
        $tpl->ID_CURSO = $t->getId();
        $tpl->NOME_CURSO = $t->getNome();
        if($t->getId() == $disciplina->getCurso()->getId()){ 
           $tpl->SELECTED = "selected";       
        } else {
            $tpl->clear("SELECTED");
        }
        
        $tpl->block("BLOCK_CURSO");
    }
    
    foreach($tutors as $p){
        $tpl->ID_TUTOR = $p->getId();
        $tpl->NOME_TUTOR = $p->getNome();
        
        if($p->getId() == $disciplina->getTutor()->getId()){ 
           $tpl->SELECTED = "selected";       
        } else {
            $tpl->clear("SELECTED");
        }
        
        $tpl->block("BLOCK_TUTOR");
    }
    

    $tpl->show();