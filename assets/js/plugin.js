(function() {
    const plugin = {
        faqs: document.querySelectorAll('.faq'),
        init: function() {
            this.faqAccordian();
            this.dynamicTabs();
        },
        faqAccordian: function() {
            this.faqs.forEach( (faq, idx) => {
                const faqContainerHeight = faq.clientHeight + "px";
                faq.style.height = faqContainerHeight;
                faq.querySelector('.toggle-faq').addEventListener('click', event => {
                    event.preventDefault();
                    const question = event.target;
                    question.classList.add('open');
                    const answer = faq.querySelector('.toggle-answer');

                    if (!answer.classList.contains('active')) {  
                        answer.classList.add('active');
                        answer.style.height = "auto";

                        let height = answer.clientHeight + "px";
                        
                        answer.style.height = '0px';
                        setTimeout(() => {
                            faq.style.height = "auto";
                            answer.style.height = height;
                        }, 0);
                    } else {
                        answer.style.height = '0px';

                        answer.addEventListener('transitionend', () => {
                            answer.classList.remove('active');
                            faq.style.height = faqContainerHeight;
                            question.classList.remove('open');
                            question.classList.add('closed');
                        }, {
                            once: true
                        });
                    }
                });
            });
        },
        dynamicTabs: function() {
            const myTabs = document.querySelectorAll("ul#myTab > li");
            for (i = 0; i < myTabs.length; i++) {
                myTabs[i].classList.remove("active");

                myTabs[i].addEventListener("click", event => {
                    event.preventDefault();

                    myTabs.forEach(tab => {
                        tab.querySelector('button').classList.remove('border-b-2');
                    });
                    event.target.classList.add('border-b-2');

                    const clickedTab     = event.currentTarget,
                          myContentPanes = document.querySelectorAll("#myTabContent > div");
                    
                    clickedTab.classList.add('border-b-2');

                    for (i = 0; i < myContentPanes.length; i++) {
                        myContentPanes[i].classList.remove("active");
                        myContentPanes[i].classList.add("hidden");
                    }

                    const anchorReference = clickedTab,
                          activePaneId    = anchorReference.querySelector('button').getAttribute("data-id"),
                          activePane      = document.getElementById(activePaneId);

                    activePane.classList.remove('hidden');
                    activePane.classList.add("active");
                });
            }
        },
    }
    plugin.init();
})();
