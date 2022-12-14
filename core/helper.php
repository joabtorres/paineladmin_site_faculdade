<?php

class helper {

    /**
     * Está função é responsável para converte uma data do padrão 'dia/mes/ano' para 'ano-mes-dia'
     * @param String $date - data solicitada pelo parametro
     * r
     * @access protected
     * @return $date - data formatada no padrão banco MySQL
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateBD($date) {
        $arrayDate = explode("/", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '-' . $arrayDate[1] . '-' . $arrayDate[0];
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para converte uma data do padrão 'ano-mes-dia' para 'dia/mes/ano'
     * @param String $date - data solicitada pelo parametro
     * r
     * @access protected
     * @return $date - data formatada no padrão brasileiro
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateView($date) {
        $arrayDate = explode("-", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '/' . $arrayDate[1] . '/' . $arrayDate[0];
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para converte uma data do padrão 'ano-mes-dia' para 'dia de mes de ano'
     * @param String $date - data solicitada pelo parametro
     * r
     * @access protected
     * @return $resultado - retorna a data dia de mês de ano 15 de agosto de 2019
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateViewComplete($date) {
        $arrayDate = explode("-", $date);
        if (count($arrayDate) == 3) {
            $resultado = $arrayDate[2] . ' de ' . $this->getMes($arrayDate[1]) . ' de ' . $arrayDate[0];
            return $resultado;
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para retorna o nome do més
     * @param String $mes = mês selecionado
     * @access protected
     * @return $resultado -  retorna os valores  'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setemmbro', 'outubro', 'novembro', 'dezembro'
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function getMes($mes) {
        $array = array('janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setemmbro', 'outubro', 'novembro', 'dezembro');
        $resultado = "";
        for ($i = 0; $i < count($array); $i++) {
            if (($i + 1) == $mes) {
                $resultado = $array[$i];
            }
        }
        return $resultado;
    }

}
