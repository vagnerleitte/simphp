<?php 

	class Email{
			
			private		$extrator;
			private		$tipo;
			private		$valido;
			private 	$tipoFile;
			private 	$extensionFile;
			private 	$toEmail;
			
			function __construct($extrator){
				$this->extrator 	= $extrator;
				//$this->extensoesOk 	= $extensoesOk;
			}
			
			private function classifyMail(){
				
				extract($this->extrator);
				
				if(!empty($assunto) AND $assunto == 'contato'){
					$this->tipo = 'Contato';
				}else
				if(!empty($assunto) AND $assunto == 'investir'){
					$this->tipo = 'Proposta';
				}else
				if(!empty($assunto) AND $assunto == 'trabalhe'){
					$this->tipo = 'Trabalhe Conosco';
				}else{
					$this->tipo = 'Servidor temporariamente fora do ar. Por favor, tente novamente mais tarde.';
					return false;
				}
				
				return $this->tipo;
				
			}
			
			private function verifyMail(){
				
				if($this->classifyMail() == 'Contato'){
					if(array_key_exists("email",$this->extrator)){
							$email = $this->extrator['email'];
							if(empty($email) OR $email == 'E-mail de Contato:' OR !preg_match("/^[a-zA-z0-9\._-]+\@[a-zA-Z0-9\._-]+\.([a-zA-Z.]{2,7})/",$email)){
								echo '
									<script>
										alert("Por favor, informe o seu e-mail!");
										window.location.href = "contato";
									</script>
									 ';
							}
					}
					foreach($this->extrator as $fields => $field){
							if(empty($field)){
								echo '
									<script>
										alert("Por favor, preencha todos os campos corretamente!");
										window.location.href = "contato";
									</script>
									 ';
							}else
							if(!empty($field) AND strstr($field,':')){
								echo '
									<script>
										alert("Por favor, preencha todos os campos corretamente!");
										window.location.href = "contato";
									</script>
									 ';
							}else{
								$this->valido = true;
							};
					}
				}else
				if($this->classifyMail() == 'Proposta'){
					if(array_key_exists("email",$this->extrator)){
							$email = $this->extrator['email'];
							if(empty($email) OR $email == 'E-mail de Contato:' OR !preg_match("/^[a-zA-z0-9\._-]+\@[a-zA-Z0-9\._-]+\.([a-zA-Z.]{2,7})/",$email)){
								echo '
									<script>
										alert("Por favor, informe o seu e-mail!");
										window.location.href = "proposta";
									</script>
									 ';
							}
					}
					foreach($this->extrator as $fields => $field){
							if(empty($field)){
								echo '
									<script>
										alert("Por favor, preencha todos os campos corretamente!");
										window.location.href = "proposta";
									</script>
									 ';
							}else
							if(!empty($field) AND strstr($field,':')){
								echo '
									<script>
										alert("Por favor, preencha todos os campos corretamente!");
										window.location.href = "proposta";
									</script>
									 ';
							}else{
								$this->valido = true;
							}															
					}																	
				}else
				if($this->classifyMail() == 'Trabalhe Conosco'){
					$this->tipoFile = $_FILES['curriculo']['type'];
					$this->extensionFile = substr($_FILES['curriculo']['name'],-4);
		
					if(array_key_exists("email",$this->extrator)){
							$email = $this->extrator['email'];
							if(empty($email) OR $email == 'E-mail de Contato:' OR !preg_match("/^[a-zA-z0-9\._-]+\@[a-zA-Z0-9\._-]+\.([a-zA-Z.]{2,7})/",$email)){
								echo '
									<script>
										alert("Por favor, informe o seu e-mail!");
										window.location.href = "trabalhe";
									</script>
									 ';
							}
					}
					
					foreach($this->extrator as $fields => $field){
							if(empty($field)){
								echo '
									<script>
										alert("Por favor, preencha todos os campos corretamente!");
										window.location.href = "trabalhe";
									</script>
									 ';
							}else
							if(!empty($field) AND strstr($field,':')){
								echo '
									<script>
										alert("Por favor, preencha todos os campos corretamente!");
										window.location.href = "trabalhe";
									</script>
									 ';
							}else{
								$this->valido = true;
							}			
					}
				}	
				
				return $this->valido;																
			}
			
			private function constructBody(){
					if($this->classifyMail() == 'Contato'){
						extract($this->extrator);
						$from 		= $email;
						$subject 	= 'Contato';
						$message    = 'Comunique-me quando lançar o site.';
						$header 	= 'From:'.$from.'';
							if(mail('contato@iggow.com',$subject,$message,$header)){
								echo '
									<script>
										alert("Enviado com sucesso!");
										window.location.href="./" ;
									</script>
									 ';
							}else{
								echo '
									<script>
										alert("Servidor fora do ar, tente novamente mais tarde!");
										window.location.href="./" ;
									</script>
									 ';
							}					
					}else
					if($this->classifyMail() == 'Proposta'){
						extract($this->extrator);
						//$servicos   = array($tipo_servico,$tipo_servico2,$tipo_servico3,$tipo_servico4,$tipo_servico5);
						$from 		= $email;
						$subject 	= 'Proposta de Investimento';
						$message   .= 'Empresa solicitante: '.$nomeEmpresa.'\r\n';
						//$message   .= 'Endere&ccedil;o da empresa: '.$Endereco.' - '.$Bairro.'\r\n'.$Cidade.' - '.$Estado.'';
						$message   .= 'Telefone para contato: '.$telefone.'\r\n';
						$message   .= 'Solicitante do pedido: '.$nome.'\r\n';
						/*foreach($servicos as $servico => $field){
							if(!empty($field)){
									$message .= 'Tipos de servi&ccedil;os solicitados: '.$field.'\r\n';
								}else{
									$message .= '';
								}
						};
						if(!empty($Tipo_Servico_Outros)){
							$message   .= 'Tipo de servi&ccedil;o caso outro: '.$Tipo_Servico_Outros.'\r\n';
						};
						$message   .= '&Aacute;rea total onde ser&aacute; efetuado o servi&ccedil;o: '.$Area_total.'\r\n';
						$message   .= 'N&uacute;mero de funcion&aacute;rios necess&aacute;rios: '.$Numero_funcionarios.'\r\n';
						$message   .= 'N&uacute;mero de banheiros existentes: '.$Numero_banheiros.'\r\n';
						if($Carga_trabalho == 'segunda_a_sabado'){
							$message   .= 'Carga hor&aacute;ria de trabalho: Segunda a S&aacute;bado\r\n';
						}else if($Carga_trabalho == 'segunda_a_sexta'){
							$message   .= 'Carga hor&aacute;ria de trabalho: Segunda a Sexta\r\n';
						}else if($Carga_trabalho == 'segunda_domingo_uma_folga'){
							$message   .= 'Carga hor&aacute;ria de trabalho: de Segunda a Domingo com 1 folga durante a semana\r\n';
						}else if($Carga_trabalho == 'escala'){
							$message   .= 'Carga hor&aacute;ria de trabalho: escala 12 x 36\r\n';
						};
						$message   .= 'Hor&aacute;rio de trabalho: '.$Horario_trabalho.'\r\n';
						if($contratar == 'mao de obra'){
							$message   .= 'Contrato: apenas m&atilde;-de-obra\r\n';
						}else 
						if($contratar == 'mao de obra e material de limpeza'){
							$message   .= 'Contrato: m&atilde;o-de-obra e material de limpeza\r\n';
						};
						if($equipamento == 'sim'){
							$message   .= 'Ser&aacute; necess&aacute;rio algum tipo de equipamento.\r\n';
						}else if($equipamento == 'nao'){
							$message   .= 'N&atilde;o ser&aacute; necess&aacute;rio nenhum tipo de equipamento.\r\n';
						};*/
						$header 	= 'From:'.$from.'';
							if(mail('financeiro@iggow.com',$subject,$message,$header)){
								echo '
									<script>
										alert("Enviado com sucesso!");
										window.location.href="./" ;
									</script>
									 ';
							}else{
								echo '
									<script>
										alert("Servidor fora do ar, tente novamente mais tarde!");
										window.location.href="./" ;
									</script>
									 ';
							}						
					}else
					if($this->classifyMail() == 'Trabalhe Conosco'){
						
						extract($this->extrator);
						$from 		= $email;
						$subject 	= 'Quero Trabalhar';
						$message    = 'Seguem meus dados para contato.';
						$header 	= 'From:'.$from.'';
							if(mail('rh@iggow.com',$subject,$message,$header)){
								echo '
									<script>
										alert("Enviado com sucesso!");
										window.location.href="./" ;
									</script>
									 ';
							}else{
								echo '
									<script>
										alert("Servidor fora do ar, tente novamente mais tarde!");
										window.location.href="./" ;
									</script>
									 ';
							}	
							
					}
					
			}
			
			function send(){
				return $this->constructBody();
			}
	}																					

?>