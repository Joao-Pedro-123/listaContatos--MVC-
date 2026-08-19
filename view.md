# Funcionalidades necessárias para o View

## O VIEW é a GUI Para o CRUD:
- [ ] Adicionar novo contato `Work In Progress`
    - [x] Definir interface basica
    - [ ] Definir como os dados serão salvos e enviados para o controller `Work In Progress`
- [ ] Deletar um Contato
- [ ] Editar todos os campos de um Contato Existente
- [x] Ver todos os dados de um contato


## CRUD
### Já fizemos
- [x] Read
- [x] Delete


### Pending
- [ ] Create
    - [ ] Contato Forms
        - [x] Dialog structure
        - [ ] Fields mask
        - [ ] Other options (max length...)
        - [ ] Dialog Style
    - [x] Dados do Contato 
        - [x] Phone Number
        - [x] E-mail
        - [x] Social Media
        - [x] Adress
        - [x] Nickname
- [ ] Update
// A question: On the update forms, the dialog form for updating should have the already existing data for the user to edit? Or can it be simply a empty dialog that updates the field????????/????/?/???/?? (the second option is simpler but not good for usability)if we think about one thing, we're going to decide: imagine i'm writing you name and i write: Paulo Victor Moras de Almda. When i look, I'll know that it's wrong, so i would update the field. Now, which one should be easier? Your name with the errors and i'll just change the letters, or empty to write everything again TT
Ahhhh!... I got it, it is needded , but............. it is kinda......... not something I want spend time developinng............................................................................. Ok, i'll do it, it's not hard, because the data is already on the array $user['nome'] that the controller has. OK! but where will we put it? follow me a second.

It's "simplier" than you're thinking, we just need to repeat that data catching with the id.
    - [ ] Dados do Contato 
        - [x] Phone Number
        - [x] E-mail
        - [x] Social Media
        - [x] Adress
        - [x] Nickname


## Styles
- [ ] Responsiveness Mobile
    - [ ] Adjust the contact infos to appear 100% on the screen
- [ ] Define icons 

