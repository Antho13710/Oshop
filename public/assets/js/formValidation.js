let app = {

    form: null,
    inputName: null,
    inputSubtitle: null,
    inputPicture: null,
    nameError: null,
    subtitleError: null,
    pictureError: null,

    init: function()
    {
        app.form = document.querySelector('#add-form');
        app.form.addEventListener('submit', app.handleForCategoryForm);
    },

    handleForCategoryForm: function(event) 
    {
        app.inputName = document.querySelector('#name');
        app.inputSubtitle = document.querySelector('#subtitle');
        app.inputPicture = document.querySelector('#picture');

        app.nameError = document.querySelector('#name-error');
        app.subtitleError = document.querySelector('#subtitle-error');
        app.pictureError = document.querySelector('#picture-error');

        if(app.inputName.value.length < 3)
        {
            app.nameError.classList.remove('hide');
            app.nameError.innerText = 'Le nom doit contenir au moins 3 caractères';
            event.preventDefault();
        }
        else
        {
            if(app.nameError.classList.contains('hide') === false)
            {
                app.nameError.classList.add('hide');
            }
        }
        
        if(app.inputSubtitle.value.length < 5) 
        {
            app.subtitleError.classList.remove('hide');
            app.subtitleError.innerText = 'Le Sous-titre doit contenir au moins 5 caractères';
            event.preventDefault();
        }
        else
        {
            if(app.subtitleError.classList.contains('hide') === false)
            {
                app.subtitleError.classList.add('hide');
            }
        }
        
    }
}

app.init();