# MVC

### Ideias
Ao registrar uma pessoa, pode haver um padrão de texto para o campo de observação do E-mail, como um select.

<b>Ex:</b> <br>
E-mail Pessoal <br>
E-mail Comercial <br>
E-mail de Contato (Talvez Contato e Comercial sejam o mesmo talvez) <br>

# Model
Atualmente nas funções no index.php

`criar(tabela, [valor1, valor2]);`
Com essa função, você pode inserir valores em qualquer tabela simplesmente colocando o `nome` dela e a `lista de valores` para serem inseridos...   
Parece legal, mas o melhor modo deve ser usar POO, criando: **Uma classe para cada tabela** ao invés de **Uma função para cada ação CRUD**. 
Como apresentado [nesse vídeo programando MVC no php](https://www.youtube.com/watch?v=JpwkgpJrOF4) e algumas perguntas rápidas no Gemini:
1. `O model do MVC (php, apache, mysql (puro)) deve conter o que?`
2. `O meu model contém as funções que permitem fazer o CRUD no banco de dados. Isso está certo?` (Ele disse que é possível 🤨, mas também existe o DAO (Data Access Object), que é a opção de **uma classe para cada tabela**)
