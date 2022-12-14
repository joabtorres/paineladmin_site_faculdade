-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Set-2021 às 03:56
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_cavanis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `status`) VALUES
(6, 'Pós-Graduação', 1),
(7, 'Comunicados', 1),
(8, 'Vestibular', 1),
(9, 'Eventos', 1),
(10, 'Desfile Cívico', 1),
(11, 'Congressos', 1),
(18, 'Minicursos ', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `data` date NOT NULL DEFAULT curdate(),
  `titulo` varchar(255) NOT NULL,
  `previo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id`, `id_categoria`, `id_usuario`, `data`, `titulo`, `previo`, `texto`, `imagem`, `status`) VALUES
(1, 9, 4, '2019-05-30', 'Ganhadores do II Workshop de Tecnologias e Finanças e Semana do Microempreendedor Individual', 'Ontem (29/05) os alunos ALAN MOZER KUMMER D’ORAZIO, CARLOS HENRIQUE DE OLIVEIRA GOMES, GADIEL YOSSEF DE OLIVEIRA DOS REIS e LUCAS RIBEIRO DO NASCIMENTO, do curso de Sistemas de Informação, turma 2019, e orientados pelos professores Celidônia do Socor', '<p><span style=\"color: #303030; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify;\">Ontem (29/05) os alunos ALAN MOZER KUMMER D&rsquo;ORAZIO, CARLOS HENRIQUE DE OLIVEIRA GOMES, GADIEL YOSSEF DE OLIVEIRA DOS REIS e LUCAS RIBEIRO DO NASCIMENTO, do curso de Sistemas de Informa&ccedil;&atilde;o, turma 2019, e orientados pelos professores Celid&ocirc;nia do Socorro de Sousa Santos e Rog&eacute;rio Barbosa Pereira, receberam Men&ccedil;&atilde;o Honrosa pelo trabalho intitulado \"BiPay: PAGAMENTO DIGITAL\", apresentado em forma de p&ocirc;ster no II WORKSHOP DE TECNOLOGIAS E FINAN&Ccedil;AS E SEMANA DO MICROEMPREENDEDOR INDIVIDUAL, realizado pela Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute;, em Novo Progresso, nos dias 20, 23 e 24 de maio de 2019.</span></p>', 'uploads/posts/post_1/c8bc9d461dff6b24164e263c823f2e46.jpg', 1),
(2, 18, 4, '2019-07-01', 'Minicurso Programação Web', 'Nos dias 29 e 30 de junho (sábado e domingo), os alunos do curso de Sistemas de Informação estiveram participando do \"Minicurso Programação Web\", organizado pela coordenadora de curso e professora Mythian Bastos Queiroz, sendo executado pelo professo', '<p><span style=\"color: #303030; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px; text-align: justify;\">Nos dias 29 e 30 de junho (s&aacute;bado e domingo), os alunos do curso de Sistemas de Informa&ccedil;&atilde;o estiveram participando do \"Minicurso Programa&ccedil;&atilde;o Web\", organizado pela coordenadora de curso e professora Mythian Bastos Queiroz, sendo executado pelo professor convidado Joab Torres Alencar. A atividade faz parte da forma&ccedil;&atilde;o do acad&ecirc;mico e contempla as horas complementares da gradua&ccedil;&atilde;o do curso. Agradecemos a todos os envolvidos, em especial ao professor Joab e demais alunos participantes.</span></p>', 'uploads/posts/post_2/b04ebceaac99f6d49b1c7ba34384544b.jpg', 1),
(3, 11, 4, '2019-07-16', 'XXXIX Congresso da Sociedade Brasileira de Computação (CSBC)', 'Quem disse que não teríamos aluno nosso no XXXIX Congresso da Sociedade Brasileira de Computação (CSBC)?\r\n\r\nA aluna Maria Rosineide da Costa Balbino, turma 2017, está representando a nossa faculdade e o curso de Sistemas de Informação no maior evento d', '<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Quem disse que n&atilde;o ter&iacute;amos aluno nosso no XXXIX Congresso da Sociedade Brasileira de Computa&ccedil;&atilde;o (CSBC)?</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A aluna Maria Rosineide da Costa Balbino, turma 2017, est&aacute; representando a nossa faculdade e o curso de Sistemas de Informa&ccedil;&atilde;o no maior evento de computa&ccedil;&atilde;o do Brasil, que este ano est&aacute; acontecendo na nossa linda capital Bel&eacute;m.</p>', 'uploads/posts/post_3/8276b163a5f7d8a9001d1fa8b0c37849.jpg', 1),
(4, 10, 4, '2019-09-11', 'Desfile cívico de 7 de setembro de 2019', 'Alunos do curso de graduação de Administração, Ciências Contábeis e Administração, acompanhados por professores e corpo técnico-administrativo, representaram a Faculdade Católica Cavanis do Sudoeste do Pará – FCCSPA, no desfile cívico de 7 de setembr', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Alunos do curso de gradua&ccedil;&atilde;o de Administra&ccedil;&atilde;o, Ci&ecirc;ncias Cont&aacute;beis e Administra&ccedil;&atilde;o, acompanhados por professores e corpo t&eacute;cnico-administrativo, representaram a Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute; &ndash; FCCSPA, no desfile c&iacute;vico de 7 de setembro, realizado em Novo Progresso na manh&atilde; de s&aacute;bado (07/09).</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A faculdade participa da a&ccedil;&atilde;o c&iacute;vica desde a autoriza&ccedil;&atilde;o da sua primeira turma no ano de 2017, e a mant&ecirc;m em seu calend&aacute;rio acad&ecirc;mico como uma pr&aacute;tica que oportuniza a viv&ecirc;ncia da cidadania, em a&ccedil;&otilde;es que provocaram a reflex&atilde;o sobre os valores que enaltecem a P&aacute;tria: solidariedade, respeito aos s&iacute;mbolos nacionais e a valoriza&ccedil;&atilde;o das ra&iacute;zes hist&oacute;ricas traduzidas na coloniza&ccedil;&atilde;o da cidade.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\"><small style=\"box-sizing: border-box; font-size: 11.9px;\">Fotos: Mythian Bastos Queiroz/Coordena&ccedil;&atilde;o de Sistemas de Informa&ccedil;&atilde;o</small></p>', 'uploads/posts/post_4/834cab611a0d43ff9804edc206fcb9a3.jpg', 1),
(5, 9, 4, '2019-09-18', 'Sebrae Summit 2019', 'O SEBRAE SUMMIT 2019 é o maior evento de mercado digital do Norte do Brasil e aconteceu no mês de setembro, no estado do Pará, trazendo grandes nomes do marketing digital, empreendedorismo e liderança, como: Estevão Rizzo, Rafael Rez, Juliano Kimura,', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">O SEBRAE SUMMIT 2019 &eacute; o maior evento de mercado digital do Norte do Brasil e aconteceu no m&ecirc;s de setembro, no estado do Par&aacute;, trazendo grandes nomes do marketing digital, empreendedorismo e lideran&ccedil;a, como: Estev&atilde;o Rizzo, Rafael Rez, Juliano Kimura, Alfredo Soares, Andr&eacute; Siqueira e Rodrigo Noll. O evento teve como objetivo fomentar, inspirar e transformar empreendedores e neg&oacute;cios da regi&atilde;o Norte, a partir da troca de experi&ecirc;ncias e conte&uacute;dos relevantes, de alta qualidade.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">No dia 18 de setembro, o evento ocorreu na cidade de Itaituba (PA) e a Faculdade Cat&oacute;lica Cavanis (FCCSPA) fez-se presente atrav&eacute;s do seu acad&ecirc;mico Diego Henrique Piva, estudante do 6&ordm; per&iacute;odo do curso de Sistemas de Informa&ccedil;&atilde;o, e da coordenadora do curso de Sistemas de Informa&ccedil;&atilde;o Mythian Bastos Queiroz.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A coordenadora de curso Mythian Queiroz, relatou que, &ldquo;&eacute; muito importante um evento dessa propor&ccedil;&atilde;o para a regi&atilde;o Sudoeste do Par&aacute;, em vista que permite uma troca enriquecedora de conhecimentos e experi&ecirc;ncias sobre o novo Marketing e a Transforma&ccedil;&atilde;o Digital pela qual o mercado mundial est&aacute; passando, e que mesmo sendo pequenos, os neg&oacute;cios independentes de seus tamanhos devem aderir para se manter competitivos e sobreviver &agrave; nova realidade.&rdquo;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">O acad&ecirc;mico Diego Henrique Piva ressaltou que &ldquo;foi um dia de grande aprendizado, com conte&uacute;dos de alto valor sobre marketing de conte&uacute;do, inbound marketing, redes sociais, marketing de relacionamento e vendas, sendo explorados por palestrantes de alt&iacute;ssima qualidade.&rdquo;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Sem d&uacute;vidas, foi uma oportunidade &uacute;nica para quem esteve presente no evento para conhecerem pessoas relevantes para os seus neg&oacute;cios, potenciais cliente e parceiros e adquirirem muito conhecimento.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\"><small style=\"box-sizing: border-box; font-size: 11.9px;\">Fotos: Sebrae PA</small></p>', 'uploads/posts/post_5/cbea2af09a6ea8890cbbbce8f907df98.jpg', 1),
(6, 9, 4, '2019-10-30', 'I Violada Universitária Cavanis', 'A \"I Turma de Ciências Contábeis\" está organizando em prol de sua formatura a \"I Violada Universitária Cavanis\", que ocorrerá no dia 09 de novembro de 2019, na Apronop / Novo Progresso. O evento contará com a participação especial da dupla Ouro Preto', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A \"I Turma de Ci&ecirc;ncias Cont&aacute;beis\" est&aacute; organizando em prol de sua formatura a \"I Violada Universit&aacute;ria Cavanis\", que ocorrer&aacute; no dia 09 de novembro de 2019, na Apronop / Novo Progresso. O evento contar&aacute; com a participa&ccedil;&atilde;o especial da dupla Ouro Preto &amp; Boiadeiro, com o pr&eacute;-show da Mara Salazar &amp; Banda.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Os interessados podem procurar os pontos de venda que s&atilde;o: Samore, Cacau Show e Super Beer.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Para mais informa&ccedil;&otilde;es, contatar o telefone (whatsapp) 93 98110-8861.</p>', 'uploads/posts/post_6/5a73648b8d32c0e23de15afecd67b50f.jpg', 1),
(7, 9, 4, '2020-08-13', 'Jantar com Show de Prêmios Cavanis', 'A Faculdade Católica Cavanis, está promovendo o Jantar com Show de Prêmios, que acontecerá no dia 29/11/2019, no Salão Paroquial da igreja Matriz.\r\n\r\nSerão sorteados 3 (três) TV\'s de 55 polegadas, 1 (uma) moto pop 110 Honda e 3 (três) carros Hyundai HB', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis, est&aacute; promovendo o Jantar com Show de Pr&ecirc;mios, que acontecer&aacute; no dia 29/11/2019, no Sal&atilde;o Paroquial da igreja Matriz.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Ser&atilde;o sorteados 3 (tr&ecirc;s) TV\'s de 55 polegadas, 1 (uma) moto pop 110 Honda e 3 (tr&ecirc;s) carros Hyundai HB20. O evento est&aacute; programado para as 19:30h.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Para mais informa&ccedil;&otilde;es, entre em contato no Whastsapp (93) 98102-3173 e adquira uma de nossas cartelas em um dos postos de vendas parceiros.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">N&atilde;o perca esta oportunidade!</p>', 'uploads/posts/post_7/e0f8bdc5af98240265d31963dbbd09b9.jpg', 1),
(8, 8, 4, '2019-11-14', 'Inscrições para o Vestibular 2020', 'A Faculdade Católica Cavanis (FCCSPA) abre as inscrições para o Vestibular 2020 até o dia 07 de dezembro de 2019, às 15h. Ao todo são 80 vagas, distribuídas entre dois cursos, são eles: Administração (40 vagas) e Ciências Contábeis (40 vagas). Para s', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis (FCCSPA) abre as inscri&ccedil;&otilde;es para o Vestibular 2020 at&eacute; o dia 07 de dezembro de 2019, &agrave;s 15h. Ao todo s&atilde;o 80 vagas, distribu&iacute;das entre dois cursos, s&atilde;o eles: Administra&ccedil;&atilde;o (40 vagas) e Ci&ecirc;ncias Cont&aacute;beis (40 vagas). Para saber mais sobre os cursos &eacute; s&oacute; clicar neste link:&nbsp;<a class=\"text-info\" style=\"box-sizing: border-box; background-color: transparent; color: #31708f; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/graduacao\" target=\"_blank\">https://www.cavanis.edu.br/graduacao</a></p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">As inscri&ccedil;&otilde;es devem ser feitas pelo site, atrav&eacute;s do link&nbsp;<a class=\"text-info\" style=\"box-sizing: border-box; background-color: transparent; color: #31708f; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/vestibular\" target=\"_blank\">https://www.cavanis.edu.br/vestibular</a>. As provas ocorrer&atilde;o no dia 8 de dezembro e o in&iacute;cio das aulas est&aacute; previsto para fevereiro. O exame ser&aacute; realizado de forma presencial.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">N&atilde;o h&aacute; limite de idade e o custo da inscri&ccedil;&atilde;o &eacute; de R$ 50,00. Para participar, basta ter conclu&iacute;do o ensino m&eacute;dio ou estar cursando, com a conclus&atilde;o at&eacute; o per&iacute;odo da matr&iacute;cula.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">O edital est&aacute; dispon&iacute;vel em:<br style=\"box-sizing: border-box;\" /><a class=\"text-info\" style=\"box-sizing: border-box; background-color: transparent; color: #31708f; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/editais_vestibular/2019/edital-07-2019.pdf\" target=\"_blank\">https://www.cavanis.edu.br/assets/medias/documentos_institucionais/editais_vestibular/2019/edital-07-2019.pdf</a></p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Matricule-se j&aacute;!</p>', 'uploads/posts/post_8/a68232359f968c2c15aaa9e6c61bb0ae.jpg', 1),
(9, 8, 4, '2019-12-08', 'Realizado o Vestibular 2020 Cavanis', 'No domingo (08) a Faculdade Católica Cavanis esteve realizando em suas instalações o Vestibular 2020. Foram ofertadas 40 vagas para o curso de Administração e 40 vagas para o curso de Ciências Contábeis.\r\n\r\nA Faculdade Católica Cavanis recebeu 31 inscr', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">No domingo (08) a Faculdade Cat&oacute;lica Cavanis esteve realizando em suas instala&ccedil;&otilde;es o Vestibular 2020. Foram ofertadas 40 vagas para o curso de Administra&ccedil;&atilde;o e 40 vagas para o curso de Ci&ecirc;ncias Cont&aacute;beis.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis recebeu 31 inscri&ccedil;&otilde;es para o Vestibular 2020. A prova iniciou &agrave;s 08h, contando com 40 quest&otilde;es de m&uacute;ltipla escolha, mais uma reda&ccedil;&atilde;o. Os estudantes aprovados iniciam as aulas no primeiro semestre de 2020.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\"><a class=\"text-info\" style=\"box-sizing: border-box; background-color: transparent; color: #31708f; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/editais_vestibular/2019/mesclado%20007%20e%20009.pdf\" target=\"_blank\">Clique aqui&nbsp;</a>e veja a sua classifica&ccedil;&atilde;o.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Foto: Cavanis.</p>', 'uploads/posts/post_9/69f9370b17763ce3231187b0ec855072.jpg', 1),
(10, 8, 4, '2019-11-20', 'Prazo para matrícula', 'Os aprovados no Vestibular 2020.1 para os cursos de Administração e Ciências Contábeis deverão a partir do dia 13 de janeiro de 2020, comparecer na secretaria da Faculdade Católica Cavanis para realizar a sua matrícula no respectivo curso de aprovaçã', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Os aprovados no Vestibular 2020.1 para os cursos de Administra&ccedil;&atilde;o e Ci&ecirc;ncias Cont&aacute;beis dever&atilde;o a partir do dia 13 de janeiro de 2020, comparecer na secretaria da Faculdade Cat&oacute;lica Cavanis para realizar a sua matr&iacute;cula no respectivo curso de aprova&ccedil;&atilde;o. As aulas iniciar&atilde;o no dia 03 de fevereiro de 2020.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&Eacute; importante verificar os documentos necess&aacute;rios para a matr&iacute;cula, s&atilde;o eles:</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; C&oacute;pia autenticada da Certid&atilde;o de Nascimento e/ou da Certid&atilde;o de Casamento;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; Documento de quita&ccedil;&atilde;o com a Justi&ccedil;a Eleitoral; dispon&iacute;vel em:&nbsp;<a style=\"box-sizing: border-box; background-color: transparent; color: #303030; text-decoration-line: none;\" href=\"http://www.tre-pa.jus.br/eleitor/certidoes/certidao-de-quitacao-eleitoral\">TRE/PA</a></p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; Documento de quita&ccedil;&atilde;o com o Servi&ccedil;o Militar, para candidato do sexo masculino;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; C&oacute;pia autenticada do Documento de Identifica&ccedil;&atilde;o (RG) ou de Registro Nacional de Estrangeiros (R.N.E), emitido pela Pol&iacute;cia Federal (se for o caso);</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; C&oacute;pia do CPF do candidato e do respons&aacute;vel, se for menor de idade;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; C&oacute;pia autenticada do Certificado de Conclus&atilde;o do Ensino M&eacute;dio;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; C&oacute;pia autenticada do Hist&oacute;rico Escolar do Ensino M&eacute;dio ou equivalente;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">&bull; 02 (duas) fotos 3x4, recentes.</p>', 'uploads/posts/post_10/25281b6d2b36c97329a826e9495d8a4d.jpg', 1),
(11, 8, 4, '2020-01-16', 'Abertas as inscrições para o Vestibular Remanescente 2020', 'A Faculdade Católica Cavanis do Sudoeste do Pará (FCCSPA), torna público o edital de nº 01, de janeiro de 2020, onde dá-se abertura ao Processo de Vestibular Remanescente para os Cursos de Administração (22 vagas) e Ciências Contábeis (14 vagas).\r\n\r\nAs', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute; (FCCSPA), torna p&uacute;blico o edital de n&ordm; 01, de janeiro de 2020, onde d&aacute;-se abertura ao Processo de Vestibular Remanescente para os Cursos de Administra&ccedil;&atilde;o (22 vagas) e Ci&ecirc;ncias Cont&aacute;beis (14 vagas).</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">As inscri&ccedil;&otilde;es dever&atilde;o ser realizadas&nbsp;<a class=\"text-info\" style=\"box-sizing: border-box; background-color: transparent; color: #31708f; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/vestibular\" target=\"_blank\">aqui no site</a>, ou na secretaria da faculdade no per&iacute;odo de 15 de janeiro a 01 de fevereiro de 2020 at&eacute; as 18:00.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">As provas ocorrer&atilde;o no dia 02 de fevereiro de 2020, no hor&aacute;rio das 08:00 at&eacute; as 12:00.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Clique&nbsp;<a class=\"text-info\" style=\"box-sizing: border-box; background-color: transparent; color: #31708f; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/editais_vestibular/2020/edital-01-2020.pdf\" target=\"_blank\">aqui</a>&nbsp;para baixar o edital.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Inscreva-se j&aacute;!</p>', 'uploads/posts/post_11/e5787c30f95847de1f530343a823a87e.jpg', 1),
(13, 7, 4, '2020-03-18', 'Nota Oficial - 18/03/2020', 'A Faculdade Católica Cavanis do Sudoeste do Pará comunica que as atividades acadêmicas presenciais serão SUSPENSAS no período de 19 a 31 de março de 2020, como medida preventiva para resguardar a saúde coletiva e conter os avanços da pandemia do coro', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute; comunica que as atividades acad&ecirc;micas presenciais ser&atilde;o SUSPENSAS no per&iacute;odo de 19 a 31 de mar&ccedil;o de 2020, como medida preventiva para resguardar a sa&uacute;de coletiva e conter os avan&ccedil;os da pandemia do corona v&iacute;rus COVID-19, conforme orienta&ccedil;&otilde;es do Decreto Estadual n&ordm; 609, publicado em 16 de mar&ccedil;o de 2020 e Portaria MEC n&ordm;343, publicada em 18 de mar&ccedil;o de 2020.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade emitir&aacute; novos comunicados, caso seja necess&aacute;ria a prorroga&ccedil;&atilde;o do per&iacute;odo de suspens&atilde;o das atividades acad&ecirc;micas.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Continuaremos avaliando, dia-a-dia, a situa&ccedil;&atilde;o. Pedimos que os interessados mantenham acesso constante aos ve&iacute;culos oficiais de comunica&ccedil;&atilde;o da FCCSPA. Em caso de d&uacute;vidas, entrem em contato pelo telefone: (93) 98102-3173.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Clique&nbsp;<a style=\"box-sizing: border-box; background-color: transparent; color: #303030; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/comunicados/nota_oficial_18_03_2020.pdf\" target=\"_blank\"><span style=\"box-sizing: border-box; color: blue;\">aqui</span></a>&nbsp;e confira a nota oficial.</p>', 'uploads/posts/post_13/1b309fd23c78fe9a6a7dd34fa91a22a9.jpg', 1),
(14, 7, 4, '2020-03-31', 'Comunicado - 31/03/2020', 'A Faculdade Católica Cavanis do Sudoeste do Pará comunica que as atividades acadêmicas continuarão suspensas no período de 01 de 10 abril de 2020, como medida preventiva para resguardar a saúde coletiva e conter os avanços da pandemia do corona vírus', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute; comunica que as atividades acad&ecirc;micas continuar&atilde;o suspensas no per&iacute;odo de 01 de 10 abril de 2020, como medida preventiva para resguardar a sa&uacute;de coletiva e conter os avan&ccedil;os da pandemia do corona v&iacute;rus COVID-19, que ainda se fazem necess&aacute;rias, conforme orienta&ccedil;&otilde;es do Decreto Municipal n&deg;18/2020, do Decreto Estadual n&ordm;609, publicado em 16 de mar&ccedil;o de 2020 e Portaria MEC n&ordm;343, publicada em 18 de mar&ccedil;o de 2020.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Continuaremos avaliando, dia-a-dia, a situa&ccedil;&atilde;o. Pedimos que os interessados mantenham acesso constante aos ve&iacute;culos oficiais de comunica&ccedil;&atilde;o da FCCSPA. Em caso de d&uacute;vidas, entrem em contato pelo telefone: (93) 98102-3173.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Clique&nbsp;<a style=\"box-sizing: border-box; background-color: transparent; color: #303030; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/comunicados/comunicado_02_31_03_2020.pdf\" target=\"_blank\"><span style=\"box-sizing: border-box; color: blue;\">aqui</span></a>&nbsp;e confira o comunicado oficial.</p>', 'uploads/posts/post_14/296894d9fc485b7ffa38f854aed9d634.jpg', 1),
(15, 7, 4, '2020-04-17', 'Comunicado - 14/04/2020', 'A Faculdade Católica Cavanis do Sudoeste do Pará comunica que as aulas presenciais continuarão SUSPENSAS até o dia 24 de abril de 2020, como medida preventiva para resguardar a saúde coletiva e conter os avanços da pandemia do corona vírus COVID-19, ', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute; comunica que as aulas presenciais continuar&atilde;o SUSPENSAS at&eacute; o dia 24 de abril de 2020, como medida preventiva para resguardar a sa&uacute;de coletiva e conter os avan&ccedil;os da pandemia do corona v&iacute;rus COVID-19, conforme orienta&ccedil;&otilde;es do Decreto Estadual n&ordm; 609, publicado em 16 de mar&ccedil;o de 2020, como medida adotado pela Institui&ccedil;&atilde;o com aulas online, conforme a portaria do MEC 343 de 17 de mar&ccedil;o de 2020 e 345 publicada no dia 19 de mar&ccedil;o de 2020.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade emitir&aacute; novos comunicados, caso seja necess&aacute;ria a prorroga&ccedil;&atilde;o do per&iacute;odo de suspens&atilde;o das aulas. Continuaremos avaliando, dia-a-dia, a situa&ccedil;&atilde;o. Pedimos que os interessados mantenham acesso constante aos ve&iacute;culos oficiais de comunica&ccedil;&atilde;o da FCCSPA. Em caso de d&uacute;vidas, entrem em contato pelo telefone: (93) 98102-3173.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Clique&nbsp;<a style=\"box-sizing: border-box; background-color: transparent; color: #303030; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/comunicados/comunicado-17-04-2020.pdf\" target=\"_blank\"><span style=\"box-sizing: border-box; color: blue;\">aqui</span></a>&nbsp;e confira o comunicado oficial.</p>', 'uploads/posts/post_15/19837c103b8ed1339023693f28c5b4ac.jpg', 1),
(16, 7, 4, '2020-05-25', 'Comunicado - 24/04/2020', 'A Faculdade Católica Cavanis do Sudoeste do Pará comunica que o recesso previsto no calendário acadêmico para julho/2020 será antecipado para o período de 27/04 a 11/05/2020, considerando:\r\n\r\na) as medidas preventivas para resguardar a saúde coletiva e', '<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade Cat&oacute;lica Cavanis do Sudoeste do Par&aacute; comunica que o recesso previsto no calend&aacute;rio acad&ecirc;mico para julho/2020 ser&aacute; antecipado para o per&iacute;odo de 27/04 a 11/05/2020, considerando:</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">a) as medidas preventivas para resguardar a sa&uacute;de coletiva e conter os avan&ccedil;os da pandemia do corona v&iacute;rus COVID-19, conforme orienta&ccedil;&otilde;es do Decreto Estadual n&ordm; 609, publicado em 16 de mar&ccedil;o de 2020;</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">b) o &sect; 2&ordm; do Art. 2&ordm; da portaria MEC 343, de 17 de mar&ccedil;o de 2020, a Portaria MEC 345 de 19 de mar&ccedil;o de 2020 e a Portaria MEC 395, de 15 de abril de 2020, que prorroga o prazo previsto no &sect; 1&ordm; do art. 1&ordm; da Portaria n&ordm; 343/2020.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">c) a necessidade de garantir o cumprimento dos dias letivos e horas-aula estabelecidos na legisla&ccedil;&atilde;o em vigor.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">A Faculdade emitir&aacute; novos comunicados, conforme necessidade. Pedimos que os interessados mantenham acesso constante aos ve&iacute;culos oficiais de comunica&ccedil;&atilde;o da FCCSPA. Em caso de d&uacute;vidas, entrem em contato pelo telefone: (93) 98102-3173.</p>\r\n<p class=\"text-justify\" style=\"box-sizing: border-box; margin: 0px 0px 10px; color: #303030; text-align: justify; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 14px;\">Clique&nbsp;<a style=\"box-sizing: border-box; background-color: transparent; color: #303030; text-decoration-line: none;\" href=\"https://www.cavanis.edu.br/assets/medias/documentos_institucionais/comunicados/comunicado_004_2020.pdf\" target=\"_blank\"><span style=\"box-sizing: border-box; color: blue;\">aqui</span></a>&nbsp;e confira o comunicado oficial.</p>', 'uploads/posts/post_16/23ddb88d7b81af0039cb5d8be2263984.jpg', 1),
(17, 7, 4, '2021-01-10', 'teste', 'adasdas', '<p>sdasdas</p>\r\n<p>&nbsp;</p>\r\n<p>sadas</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/749vVBC4m1M\" width=\"560\" height=\"315\" frameborder=\"0\" allowfullscreen=\"\"></iframe></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>asdsadsadsa</p>', 'uploads/posts/post_17/d822462354be3e5c21295742f9694902.jpg', 1),
(18, 10, 1, '2021-01-10', 'asdasdas', 'asdasdasdas dsa das das', '<p>asdasd asd asd as</p>\r\n<p>&nbsp;</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/JsgrAnWl4mE\" width=\"560\" height=\"315\" frameborder=\"0\" allowfullscreen=\"\"></iframe></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>asdasdas das</p>', 'uploads/posts/post_18/e01ff31da7eb9fbd66e970395f5208cc.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_img`
--

CREATE TABLE `post_img` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_post` int(11) UNSIGNED NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post_img`
--

INSERT INTO `post_img` (`id`, `id_post`, `imagem`) VALUES
(33, 1, 'uploads/posts/post_1/normal_2cff4ef2a16fa259f7ecdb5c8c166654.jpg'),
(34, 1, 'uploads/posts/post_1/normal_4d32565a1fd84abeba1e68b5afb42ec8.jpg'),
(37, 2, 'uploads/posts/post_2/normal_c748ba989028d453a6a5f705a1c38e5a.jpg'),
(38, 2, 'uploads/posts/post_2/normal_ca8072a9d3b9943961f5aa72394b9134.jpg'),
(39, 2, 'uploads/posts/post_2/normal_1f0939f67933b58d1537e6f7ac4b1d10.jpg'),
(40, 2, 'uploads/posts/post_2/normal_2ad95d093c1a7b940b0bff020d401c07.jpg'),
(41, 2, 'uploads/posts/post_2/normal_aba93ff967f74f7b8726aa6e585b31e5.jpg'),
(42, 2, 'uploads/posts/post_2/normal_da16f89f2006721e0cb4c2cc99831f08.jpg'),
(43, 3, 'uploads/posts/post_3/normal_a64c0fec007e424af5725aa0e97d825a.jpg'),
(44, 3, 'uploads/posts/post_3/normal_630c116d5e42f0a925c5b78cf7d5911e.jpg'),
(45, 3, 'uploads/posts/post_3/normal_88f9276f641748acacb99767579af2bd.jpg'),
(46, 4, 'uploads/posts/post_4/normal_c0df43d35dfbe9eaa5a285fd5805cf60.jpg'),
(47, 4, 'uploads/posts/post_4/normal_1ac972ae7a3b5c98815a625812e12513.jpg'),
(48, 4, 'uploads/posts/post_4/normal_660271dc9d7d197668715c5f916688fe.jpg'),
(49, 4, 'uploads/posts/post_4/normal_2997e2e181419333fa275e658546f96c.jpg'),
(50, 4, 'uploads/posts/post_4/normal_3d5fd1cd95a86998753e6e5c90522967.jpg'),
(51, 4, 'uploads/posts/post_4/normal_3538fbc9388fe3334b5dfb8f8152b658.jpg'),
(52, 4, 'uploads/posts/post_4/normal_888156190685efc4c36f2855efd42bcb.jpg'),
(53, 4, 'uploads/posts/post_4/normal_44b8c62c18355bc8f9f762af5fa77418.jpg'),
(54, 4, 'uploads/posts/post_4/normal_eef379f5e2e0c528e94773bea956d1d0.jpg'),
(55, 5, 'uploads/posts/post_5/normal_56cd13ddb7e01b000c69d22170e79759.jpg'),
(56, 5, 'uploads/posts/post_5/normal_372a8cb0355dfe5a6e6d95a9d9b1bf9c.jpg'),
(57, 5, 'uploads/posts/post_5/normal_ac8f7b41db6a720ee44a8cfc234384fd.jpg'),
(58, 5, 'uploads/posts/post_5/normal_97d9f52fe147c77a3953207d85097635.jpg'),
(59, 5, 'uploads/posts/post_5/normal_025237c5c723dbea455caa919940cfb5.jpg'),
(60, 5, 'uploads/posts/post_5/normal_f3ef13d307cfe5fe468765d76093b441.jpg'),
(61, 6, 'uploads/posts/post_6/normal_42b83522f8eddf31397f64fb0b647eb3.jpg'),
(62, 7, 'uploads/posts/post_7/normal_d646414e6943cb4d0e980e35ac5d3ed3.jpg'),
(63, 8, 'uploads/posts/post_8/normal_ec8d7fedc1b3afa4e3817f696336cf00.jpg'),
(64, 9, 'uploads/posts/post_9/normal_c189968422d504b4c22dca2cccf9a3ac.jpg'),
(65, 10, 'uploads/posts/post_10/normal_1efb9224d282b0d6f94c6ff4e26f9766.jpg'),
(66, 11, 'uploads/posts/post_11/normal_5ac060c0e005a5bf4d7489fcfa34551e.jpg'),
(68, 13, 'uploads/posts/post_13/normal_a4f9c3667f0f6fcd17310a2568e17dc5.jpg'),
(69, 15, 'uploads/posts/post_15/normal_f3431cdd7c4b30a6ed023624bd92576d.jpg'),
(70, 16, 'uploads/posts/post_16/normal_053e458b8a2aaa6a0cc0286020e84a2d.jpg'),
(100, 17, 'uploads/posts/post_17/normal_dda2924d08a94cb96367be4fd71e9a20.jpg'),
(104, 18, 'uploads/posts/post_18/normal_8ce4f14187bba69bf0f8a756af8f4386.jpg'),
(105, 18, 'uploads/posts/post_18/normal_7fafa42a3deaa7f8e5c422411dada271.jpg'),
(106, 18, 'uploads/posts/post_18/normal_88d6401babad827504da9249714e50ae.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_img_min`
--

CREATE TABLE `post_img_min` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_post` int(11) UNSIGNED NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post_img_min`
--

INSERT INTO `post_img_min` (`id`, `id_post`, `imagem`) VALUES
(19, 1, 'uploads/posts/post_1/miniatura_8094ed6ce0d9bfbfaf11ec583f3f794c.jpg'),
(20, 1, 'uploads/posts/post_1/miniatura_aa9cef9d592024752c67b63fc6e5926b.jpg'),
(23, 2, 'uploads/posts/post_2/miniatura_fa893c18d56f7d587827b12bb52183b4.jpg'),
(24, 2, 'uploads/posts/post_2/miniatura_356898022091f182ce1e3f6d46d4f4e6.jpg'),
(25, 2, 'uploads/posts/post_2/miniatura_fd7d921ae8a88f8087070603a01ac349.jpg'),
(26, 2, 'uploads/posts/post_2/miniatura_d0c082a41667bb12e6fc0c4f78eb211e.jpg'),
(27, 2, 'uploads/posts/post_2/miniatura_06b1202790a9d28863d330208714f45e.jpg'),
(28, 2, 'uploads/posts/post_2/miniatura_a14997b621855b2cef8faa11247da2d2.jpg'),
(29, 3, 'uploads/posts/post_3/miniatura_326ff236c4b00f37b548651239473ec9.jpg'),
(30, 3, 'uploads/posts/post_3/miniatura_061ed97f2f52923009f70dbe53996afe.jpg'),
(31, 3, 'uploads/posts/post_3/miniatura_33d9f684340a89953554342b2f56fff1.jpg'),
(32, 4, 'uploads/posts/post_4/miniatura_f9f86ade5dc72bab93e9e44be46b3e68.jpg'),
(33, 4, 'uploads/posts/post_4/miniatura_9732d3f20b1fda2355347a4904c7aee6.jpg'),
(34, 4, 'uploads/posts/post_4/miniatura_a9a96ff226318a45d9ad590cff2df522.jpg'),
(35, 4, 'uploads/posts/post_4/miniatura_b33d909eb7dc50cf1d1c4e4eb87169cf.jpg'),
(36, 4, 'uploads/posts/post_4/miniatura_06831718aadb64e9b49395109082a67d.jpg'),
(37, 4, 'uploads/posts/post_4/miniatura_85a042ba873f56ae9e99fb0226fe0e37.jpg'),
(38, 4, 'uploads/posts/post_4/miniatura_bb3e7393da10fcce6d779801b605f5ce.jpg'),
(39, 4, 'uploads/posts/post_4/miniatura_fb0a90d1f8fc72aa92b304b7a2cfaca6.jpg'),
(40, 4, 'uploads/posts/post_4/miniatura_c0b4e8b0fb2607ba12d2438dbe66b3f1.jpg'),
(41, 5, 'uploads/posts/post_5/miniatura_e3daa650e80d548c0784821e445c2edb.jpg'),
(42, 5, 'uploads/posts/post_5/miniatura_6614499f7e9635b28d0228c1ddeecfde.jpg'),
(43, 5, 'uploads/posts/post_5/miniatura_fcaab44f0c7b880007ed9c5d279023ed.jpg'),
(44, 5, 'uploads/posts/post_5/miniatura_20df057632b521e50597014ed92dca4b.jpg'),
(45, 5, 'uploads/posts/post_5/miniatura_1675285654d94c3ee3b1dbf78c411ac1.jpg'),
(46, 5, 'uploads/posts/post_5/miniatura_00fb8771d2e06c1e86cb12e2d4d0b66f.jpg'),
(47, 6, 'uploads/posts/post_6/miniatura_82b30626e388e351171530d5218a9b50.jpg'),
(48, 7, 'uploads/posts/post_7/miniatura_5ec9c875b90f0506177a4b00b5c74fea.jpg'),
(49, 8, 'uploads/posts/post_8/miniatura_787d2612a31f80393736db932a78da12.jpg'),
(50, 9, 'uploads/posts/post_9/miniatura_250e2283412a9e728671fcfa438632cc.jpg'),
(51, 10, 'uploads/posts/post_10/miniatura_91361754fc58dd29e9e0ef80f8eb25fe.jpg'),
(52, 11, 'uploads/posts/post_11/miniatura_511bb7719668252c1099cf1f8221c2c5.jpg'),
(54, 13, 'uploads/posts/post_13/miniatura_8f71f5b9ff60c89810cac3de14bda759.jpg'),
(55, 15, 'uploads/posts/post_15/miniatura_6a45de854deb36df3227064f0cdcc653.jpg'),
(56, 16, 'uploads/posts/post_16/miniatura_d50c0d8e4a581201fbb40a9602ad0158.jpg'),
(82, 17, 'uploads/posts/post_17/miniatura_3b0c2917df873cca9597d094219fd258.jpg'),
(86, 18, 'uploads/posts/post_18/miniatura_5f0771f1e54016b4fc8eb29c4f7b73d0.jpg'),
(87, 18, 'uploads/posts/post_18/miniatura_56fbfc5b17aa99d090fce83478af6e7e.jpg'),
(88, 18, 'uploads/posts/post_18/miniatura_3399fd2a7ac705a75387bc0328e785fe.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `slide`
--

CREATE TABLE `slide` (
  `id` int(10) UNSIGNED NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `slide`
--

INSERT INTO `slide` (`id`, `imagem`, `link`, `status`) VALUES
(12, 'uploads/slides/a87bee32351b1f169f35ec7f50c5695c.jpg', 'https://www.cavanis.edu.br/noticias/inscricao_pos_graduacao2020', 1),
(13, 'uploads/slides/082bce64e3bcb7fa5f3eff9a4d863ac0.jpg', '', 1),
(14, 'uploads/slides/a7858b04e2ed766569b4491168a5ed51.jpg', '', 1),
(15, 'uploads/slides/c23bcce72367f779fe860d6ad5fc89a2.jpg', 'http://localhost/virtualhost/cavanis/contato/ouvidoria', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '0',
  `senha` varchar(32) NOT NULL DEFAULT '',
  `imagem` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `imagem`, `status`) VALUES
(1, 'Joab T. Alencar', 'joabtorres1508@gmail.com', '47cafbff7d1c4463bbe7ba972a2b56e3', 'uploads/usuarios/b9c5caf150a1e466e06bdde6f62e81c8.jpg', 1),
(4, 'Cavanis', 'cavanis@cavanis.edu.br', '718bc16013d36a3c9f7cf1d6d53faf0c', NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `post_img`
--
ALTER TABLE `post_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `post_img_min`
--
ALTER TABLE `post_img_min`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Índices para tabela `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `post_img`
--
ALTER TABLE `post_img`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de tabela `post_img_min`
--
ALTER TABLE `post_img_min`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de tabela `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK__categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_post_usuario2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `post_img`
--
ALTER TABLE `post_img`
  ADD CONSTRAINT `FK__post2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`);

--
-- Limitadores para a tabela `post_img_min`
--
ALTER TABLE `post_img_min`
  ADD CONSTRAINT `FK__post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
