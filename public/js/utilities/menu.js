window.addEventListener('load', ()=>{
    const buttonsTabs = document.querySelectorAll('button[data-tab-target]')
    const contentTabs = document.querySelectorAll('div[data-tab-id]')

    renderTabs('1');

    for(const button of buttonsTabs){
        button.addEventListener('click', activeTab)
    }

    function activeTab(e){
        const id = e.target.getAttribute('data-tab-target');
        renderTabs(id);
    }

    function renderTabs(id){
        for(const tab of contentTabs){
            console.log('id de la tab' + tab.getAttribute('data-tab-id'))
            const idtab = parseInt(tab.getAttribute('data-tab-id'));
            if( idtab === parseInt(id)){
                console.log('entra')
                tab.classList.remove('d-none')
            }else{
                tab.classList.add('d-none')
            }
        }
    }
})
