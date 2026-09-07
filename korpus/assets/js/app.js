document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.querySelectorAll('.contact-form');
    if (contactForm) {
        contactForm.forEach(function(form) {
            const formPhone = form.querySelector('[data-validate-field="tel"]');
            const formName = form.querySelector('[data-validate-field="name"]');
            const formSurname = form.querySelector('[data-validate-field="surname"]');
            const formMessage = form.querySelector('[data-validate-field="message"]');
            const formMail = form.querySelector('[data-validate-field="mail"]');
            
            const formPolicyCheckbox = form.querySelector('.contact-form__wrapper-form-policy--policy input');
            const formSendCheckbox = form.querySelector('.contact-form__wrapper-form-policy--send input');
        
            const formAllInput = form.querySelectorAll('[data-validate-field]');
            const contactFormSubmitBtn = form.querySelector('.contact-form-submit');
            
            let hasSelected = false;

            let regx = /^((([0-9A-Za-z]{1}[-0-9A-z\\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\\.){1,2}[-A-Za-z]{2,})$/u;
            
            formAllInput.forEach(function(item) {
                item.addEventListener('focus', function() {
                    item.parentElement.classList.remove('g-input-error');
                    item.parentElement.classList.remove('policy-error');
                })
            });
            
            formPolicyCheckbox.addEventListener('change', function() {
                if(this.checked) {
                    formPolicyCheckbox.parentElement.classList.remove('policy-error');
                }
            });
            
            formSendCheckbox.addEventListener('change', function() {
                if(this.checked) {
                    formSendCheckbox.parentElement.classList.remove('policy-error');
                }
            });
        
            contactFormSubmitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                let errCount = 0;
        
                if(formName) {
                    if (formName.value.length === 0) {
                        formName.parentElement.classList.add('g-input-error');
                        errCount++;
                    } else { formName.parentElement.classList.remove('g-input-error') }
                } 
        
                if(formSurname) {
                    if (formSurname.value.length === 0) {
                        formSurname.parentElement.classList.add('g-input-error');
                        errCount++;
                    } else { formSurname.parentElement.classList.remove('g-input-error') }
                }
        
                if(formMail) {
                    if (formMail.value.length === 0 || !regx.test(formMail.value)) {
                        formMail.parentElement.classList.add('g-input-error');
                        errCount++;
                    } else { formMail.parentElement.classList.remove('g-input-error') }
                } 
        
                if(formPhone) {
                    if (formPhone.value.length >= 24 || formPhone.value.length === 0 || formPhone.value.length < 15) {
                        formPhone.parentElement.classList.add('g-input-error');
                        errCount++;
                    } else { formPhone.parentElement.classList.remove('g-input-error') }
                } 
                    
                if(form.querySelector('.select-box-init')) {
                    if (hasSelected === false) {
                        form.querySelector('.select-box-init').classList.add('g-select-error');
                        errCount++;
                    } else {
                        form.querySelector('.select-box-init').classList.remove('g-select-error');
                    }
                }

                // Проверка чекбоксов - на мобильных они необязательны
                const isMobile = window.innerWidth <= 500 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                
                if(formPolicyCheckbox && !isMobile) {
                    if (formPolicyCheckbox.checked == false) {
                        errCount++;
                        formPolicyCheckbox.parentElement.classList.add('policy-error');
                    } else { formPolicyCheckbox.classList.remove('policy-error') }
                }
        
                if(formSendCheckbox && !isMobile) {
                    if (formSendCheckbox.checked == false) {
                        errCount++;
                        formSendCheckbox.parentElement.classList.add('policy-error');
                    } else { formSendCheckbox.classList.remove('policy-error') }
                } 
        
                if (errCount === 0) {
                    
                    jQuery(function($) {
                        var cf = $('#contactForm');
                        $.ajax({
                            type: "POST",
                            url: '/wp-admin/admin-ajax.php?action=send_mail',
                            data: cf.serialize()
                        }).done(function(data) {
                            if (data.success) {
                                form.querySelector('.contact-form__container').classList.add('none');
                                form.querySelector('.contact-form__thx').classList.remove('none');
                            } else {
                                alert(data.data.message || 'Error sending message');
                            }
                        }).fail(function() {
                            alert('Network error. Please try again.');
                        });
                    });
                   
                }
            });

            // SELECT-BOX

            form.querySelectorAll('.select-box').forEach(function(select) {
                const selected = select.querySelector(".select-box-current");
                const optionsContainer = select.querySelector(".options-container");
                const selectArrow = select.querySelector(".select-box-arrow");
                const optionsList = select.querySelectorAll(".option");
            
                document.addEventListener('click', (event) => {
                    let isClickInsideElement = selected.contains(event.target); 
                    if (!isClickInsideElement) {
                        optionsContainer.classList.remove("active");
                        selectArrow.classList.remove("select-box-arrow-opened");
                    }
                });
            
                selected.addEventListener("click", () => {
                    optionsContainer.classList.toggle("active");
                    selectArrow.classList.toggle("select-box-arrow-opened");
                    select.classList.remove('g-select-error');
                });
            
                optionsList.forEach(o => {
                    o.addEventListener("click", () => {
                        hasSelected = true;
                        selected.innerHTML = o.querySelector("label").innerHTML;
                        optionsContainer.classList.remove("active");
                        selectArrow.classList.remove("select-box-arrow-opened");
                    });
                });
            })
            
        })
    }
});


/*if (document.querySelector('.services__cookies')) {
    const cookies = document.querySelector('.services__cookies');
    const allCookiesBtns = document.querySelectorAll('.cookies-btn');

    allCookiesBtns.forEach(function(cookieBtn) {
        cookieBtn.addEventListener('click', function() {
            cookieBtn.classList.add('active');
            cookies.classList.remove('show');
        })
    });
}*/\nif (document.querySelector('.cookies')) {
    function validateCookiesDesc() {
        const allSettingsItems = document.querySelectorAll('.cookies__settings-item');
        allSettingsItems.forEach(function(item) {
            item.querySelector('header .switcher-checkbox').addEventListener('change', function() {
                item.classList.toggle('show');
                let contentContainerHeight = Number((parseFloat((item.querySelector('.cookies__settings-item-content main').clientHeight) / window.innerWidth) * 100).toFixed(4));
                let contentContainerItem = item.querySelector('.cookies__settings-item-content');
    
                if(!item.classList.contains('show')) {
                    contentContainerItem.style.height = ``;
                } else {
                    contentContainerItem.style.height = `${contentContainerHeight}vw`;
                }
                
                window.addEventListener("resize", () => {    
                    contentContainerItem.style.height = ``;
                    item.classList.remove('show');
                });
            });

            if(item.querySelector('header .switcher-checkbox input').checked) {
                let contentContainerItem = item.querySelector('.cookies__settings-item-content');
                let contentContainerHeight = Number((parseFloat((item.querySelector('.cookies__settings-item-content main').clientHeight) / window.innerWidth) * 100).toFixed(4));
                contentContainerItem.style.height = `${contentContainerHeight}vw`;
            }
        }); 
    }

    validateCookiesDesc();
}
if(document.querySelector('.first-tab')) {
    const firstTab = document.querySelector('.first-tab');
    const servicesSection = document.querySelector('.services');
    const switchBar = document.querySelector('.switchbar__btn');

    switchBar.addEventListener('click', function() {
        // code...
    }); 
}
function growingAnim(elements) {
    if (elements) {
        let allElements = Array.from(elements);
        document.addEventListener('DOMContentLoaded', function() {
            function mainAnim() {
                allElements.forEach(function(item, index) {
                    let fullHd = 12.76041;     // DESKTOP SIZE OF ITEM IN VW
                    let mediumHd = 14.50972;     // DESKTOP SIZE OF ITEM IN VW
                    let mbHeight = 44.266;         // MOBILE SIZE OF ITEM IN VW
                    let pcHeight = window.innerWidth > 1440 ? fullHd : mediumHd;
                    let currentHeight = window.innerWidth <= 500 ? mbHeight : pcHeight;
    
                    item.classList.add('disabled');
                    item.style.transitionDuration = `${allElements.length - index}s`;
                    item.style.height = `${currentHeight * (index + 1)}vw`;
                    item.style.zIndex = `${10 * (allElements.length - index)}`;
                    setTimeout(function() {
                        item.style.removeProperty('transition');
                        item.classList.add('services__item--cirlce-item');
                        item.classList.remove('disabled');

                        allElements.forEach(function(i) {
                            i.style.height = ``;
                            i.style.transitionDuration = `4s`;
                            i.querySelector('.services__item-content').style.removeProperty('height');
                            i.classList.add('services__item--ready');
                            i.classList.remove('active');
                        });

                        document.querySelector('.services__cookies').classList.remove('none');
                        setTimeout(function() {
                            document.querySelector('.services__cookies').classList.add('show');
                        }, 200);
                        
                    }, 1000 * allElements.length);
                    setTimeout(function() {
                        item.querySelector('main').classList.remove('none');
                    }, 500);
                })
            }
            mainAnim();
        })
    }
}

function openServiceItemPc(allItems) {
    if (allItems) {
        allItems.forEach(function(item) {
            item.querySelector('main header').addEventListener('click', function() {
                if (!item.classList.contains('disabled')) {
                    if(item.classList.contains('active')) {
                        item.classList.remove('active');
                    } else {
                        allItems.forEach(function(i) {
                            i.style.height = ``;
                            i.style.transitionDuration = `4s`;
                            i.querySelector('.services__item-content').style.removeProperty('height');
                            i.classList.add('services__item--ready');
                            i.classList.remove('active');
                        })
    
                        item.style.height = 'fit-content';
                        setTimeout(function() {
                            item.classList.add('active');
                        }, 200)
                    }
                }
            });
        });
    }
}

function openServiceItemMb(allItems) {
    if (allItems) {
        allItems.forEach(function(item) {
            item.querySelector('main header').addEventListener('click', function() {
                let contentHeight = Number((parseFloat((item.querySelector('.services__item-content-links').clientHeight) / window.innerWidth) * 100).toFixed(4));

                if (!item.classList.contains('disabled')) {
                    if(item.classList.contains('active')) {
                        item.classList.remove('active');
                        item.querySelector('.services__item-content').style.height = ``;
                    } else {
                        allItems.forEach(function(i) {
                            i.style.height = ``;
                            i.style.transitionDuration = `4s`;
                            i.querySelector('.services__item-content').style.removeProperty('height');
                            i.classList.add('services__item--ready');
                            i.classList.remove('active');
                        });

                        item.querySelector('.services__item-content').style.height = `${contentHeight}vw`;

                        setTimeout(function() {
                            item.classList.add('active');
                        }, 200)
                    }
                }
            });
        });
    }
}

if (window.innerWidth <= 500) {
    openServiceItemMb(document.querySelectorAll('.services__item'));
} else {
    openServiceItemPc(document.querySelectorAll('.services__item'));
}

growingAnim(document.querySelectorAll('.services__item'));
function yearExtended(items) {
    if (items) {
        items.forEach(function(item, index) {
            item.addEventListener('click', function() {
                items.forEach(function(i) {
                    i.style.height = '';
                    i.classList.remove('active');
                });
      
                const itemHeight = item.querySelector('main').clientHeight;
                const itemHeightVW = Number((parseFloat(itemHeight / window.innerWidth) * 100).toFixed(4));
                item.style.height = `${itemHeightVW}vw`;
                item.classList.add('active');
            });
        });
    }
}

function limitingArrowSize() {
    const allItems = document.querySelectorAll('.history__content-table-item');
    if (window.innerWidth <= 500) {
        allItems.forEach(function(item) {
            let yearSize = Number((parseFloat((item.querySelector('main time').clientWidth) / window.innerWidth) * 100).toFixed(4));
            let arrowMove = item.querySelector('main .history__content-table-item-arrow');
    
            arrowMove.style.maxWidth = `calc(100% - ${yearSize + 5.3333}vw)`;
        });
    } else { 
        allItems.forEach(function(item) {
            item.querySelector('main .history__content-table-item-arrow').style.removeProperty('max-width');
            item.style.removeProperty('height');
            item.classList.remove('active');
        });
    }
}

yearExtended(document.querySelectorAll('.history__content-table-item'));
limitingArrowSize();

window.addEventListener("resize", () => {    
    limitingArrowSize();
});
const tels = document.querySelectorAll('input[type="tel"]');

if (tels) {
    tels.forEach(el => {
        IMask(el, { mask: "+ {0} (000) 000 00 000 00" });
    });
}
if (document.querySelectorAll('[data-language-switcher]')) {
    const allLangSwitchers = document.querySelectorAll('[data-language-switcher]');
    allLangSwitchers.forEach(function(switcher) {
        switcher.querySelectorAll('button').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let currentLanguage = btn.getAttribute('data-language');
                switcher.setAttribute('data-language-switcher', currentLanguage);
            });
        });
    });
}
const observer = lozad('.lozad', {
    loaded: function(img) {
        img.addEventListener('load', function() {
            img.classList.add('loaded');
        });
        
        if(img.hasAttribute('data-background-image')) {
            img.classList.add('loaded');
        };
    },
});

observer.observe();
function manangeActiveBtns(allBtns) {
    if (allBtns) {
        allBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                allBtns.forEach(function(b) {b.classList.remove('active')});
                btn.classList.add('active');
            });
        });
    }
}

manangeActiveBtns(document.querySelectorAll('.team__heading ul button'));
manangeActiveBtns(document.querySelectorAll('.history__heading ul button'));
manangeActiveBtns(document.querySelectorAll('.cookies__panel-btns button'));
manangeActiveBtns(document.querySelectorAll('.cookies__panel-btns button'));

document.querySelectorAll('.services__item-content-products-items-tags').forEach(function(btns) {
    manangeActiveBtns(btns.querySelectorAll('button'));
})
if (document.querySelector('.media__slider')) {
    let mediaSlider = new Swiper(".media__slider", {
        spaceBetween: 60,
        
        navigation: {
            nextEl: ".arrows-item-media--next",
            prevEl: ".arrows-item-media--prev",
        },
    });
}
if (document.querySelector('.burger')) {
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.menu');
    const switchbar = document.querySelector('.switchbar');
    const body = document.querySelector('body');

    burger.addEventListener('click', function() {
        burger.classList.toggle('isOpen');

        if (burger.classList.contains('burger--menu')) {
            burger.disabled = true;
            switchbar.querySelector('.switchbar__btn').disabled = true;
            switchbar.classList.toggle('disabled');
            if (switchbar.querySelector('.switchbar__btn').disabled === true) {
                switchbar.querySelector('.switchbar__btn').disabled = false;
            }
    
            menu.classList.toggle('t-anim');
            body.classList.remove('purple-mood');
                
            menu.classList.toggle('open');
            // menu.querySelector('.menu__footer').classList.add('hide');
    
            if (document.querySelector('.second-tab').classList.contains('show')) {
                if (!menu.classList.contains('open')) {
                    setTimeout(function() {
                        body.classList.add('purple-mood');
                    }, 500);
                }
            }
    
            setTimeout(function() {
                burger.disabled = false;
                menu.classList.toggle('t-anim');
                // menu.querySelector('.menu__footer').classList.remove('hide');
            }, 1500);
        }
    });
}

function resizeMenuItem() {
    if (document.querySelectorAll('.menu__list-item')) {
        document.querySelectorAll('.menu__list-item').forEach(function(item) {
            let itemHeight = Number((parseFloat((item.clientHeight) / window.innerWidth) * 100).toFixed(4));
            
            item.addEventListener('click', function() {
                let itemActiveHeight = item.querySelector('main').clientHeight;
                let itemActiveVwHeight = (parseFloat((itemActiveHeight) / window.innerWidth) * 100).toFixed(4);

                if(item.classList.contains('active')) {
                    item.classList.toggle('active');
                    item.style.height = `${itemHeight}vw`;
                } else {
                    item.classList.toggle('active');
                    item.style.height = `${Number(itemActiveVwHeight) +  0.1388}vw`;
                }
            });
        });
    }
}

resizeMenuItem();
function addClassOnEyeContact(elements, timeout) {
    if (elements) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(function() {
                        entry.target.classList.add('show');
                    }, timeout);
                }
            });
        });
        
        if (elements.length) {
            elements.forEach(element => {
                observer.observe(element);
            });
        }
    }
}

function addClassOnEyeContactDelay(elements, timeout) {
    if (elements) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(function(entry, index) {
                if (entry.isIntersecting) {
                    setTimeout(function() {
                        entry.target.classList.add('show');
                    }, timeout * (index + 1));
                }
            });
        });
        
        if (elements.length) {
            elements.forEach(element => {
                observer.observe(element);
            });
        }
    }
}

addClassOnEyeContact(document.querySelectorAll('.burger span:first-child'), 0);
addClassOnEyeContact(document.querySelectorAll('.burger span:last-child'), 300);
addClassOnEyeContact(document.querySelectorAll('.services__item-paragraph'), 0);
addClassOnEyeContact(document.querySelectorAll('.contact-form__thx'), 0);
addClassOnEyeContact(document.querySelectorAll('.contacts__content-info, .contacts__content-community, .contacts__content-form, .contact-form__thx, .contact-form__container'), 0);
addClassOnEyeContact(document.querySelectorAll('.team__content-employees'), 0);
addClassOnEyeContact(document.querySelectorAll('.history__content-table'), 0);
addClassOnEyeContact(document.querySelectorAll('.services__item-content-products-items'), 0);
addClassOnEyeContact(document.querySelectorAll('.services__item-content-products-items-scope p'), 0);

addClassOnEyeContactDelay(document.querySelectorAll('.fade-in-anim'), 100);
addClassOnEyeContactDelay(document.querySelectorAll('.about__content-links ul a'), 200);
function initScrollbar(scrollContainer) {
    if (scrollContainer) {
        Scrollbar.init(scrollContainer, { damping: .8 });
    }
}

initScrollbar(document.querySelector('.first-tab'));
initScrollbar(document.querySelector('.menu__container'));
initScrollbar(document.querySelector('.second-tab__wrapper'));
document.querySelectorAll('.mobile-tab').forEach(function(certainTab) {
    initScrollbar(certainTab);
});
const smoothLinks = document.querySelectorAll('a[href^="#"]');
if (smoothLinks) {
    for (let smoothLink of smoothLinks) {
        smoothLink.addEventListener('click', function (e) {
            e.preventDefault();
            const id = smoothLink.getAttribute('href');
    
            if (id === "#") return
            document.querySelector(id).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    };
}
/*if (document.querySelector('.switchbar')) {
    const firstTab = document.querySelector('.first-tab');
    const secondTab = document.querySelector('.second-tab');
    const switchbar = document.querySelector('.switchbar');

    switchbar.addEventListener('click', function() {
      switchbar.classList.toggle('active');
      firstTab.classList.toggle('hide');
      secondTab.classList.toggle('show');
      document.querySelector('body').classList.toggle('purple-mood');
    });
}*/\nfunction initializeMobileTabs(links) {
    if (links) {
        links.forEach(function(link) {
            const allMobileTabs = document.querySelectorAll('.mobile-tab');
            allMobileTabs.forEach(function(mobileTab) {
                if (mobileTab.getAttribute('data-mobile-tab-container') === link.getAttribute('data-mobile-tab-links')) {
                    const mobileTabSliderOnPage = mobileTab.querySelector('.mobile-tab__slider');
                    const mobileTabSliderArrowNext = mobileTab.querySelector('.arrows-item-mobile-tab--next');
                    const mobileTabSliderArrowPrev = mobileTab.querySelector('.arrows-item-mobile-tab--prev');
                    
                    const allTabBtns = link.querySelectorAll('[data-mobile-tab-btn]');
                    const burger = document.querySelector('.burger');
        
                    let mobileSliderTab = new Swiper(mobileTabSliderOnPage, {
                        spaceBetween: 60,
                        allowTouchMove: false,
                        slidesPerView: "auto",
                        effect: "fade",
                        // autoHeight: true,
                
                        navigation: {
                            nextEl: mobileTabSliderArrowNext,
                            prevEl: mobileTabSliderArrowPrev,
                        },
                    });
            
                    allTabBtns.forEach(function(btn) {
                        if(window.innerWidth <= 500) {
                            btn.addEventListener('click', function() {
                                let ordinalNumber = Number(btn.getAttribute('data-mobile-tab-btn'));
                                
                                burger.classList.toggle('burger--menu');
                                burger.classList.toggle('burger--mobile-tab');
                                burger.classList.toggle('isOpen');
    
                                mobileTab.classList.toggle('open');
                                
                                mobileSliderTab.slideTo(ordinalNumber - 1);
                            })
                        }
                        window.addEventListener("resize", () => {
                            if(window.innerWidth <= 500) {
                                btn.addEventListener('click', function() {
                                    let ordinalNumber = Number(btn.getAttribute('data-mobile-tab-btn'));
                                    
                                    burger.classList.toggle('burger--menu');
                                    burger.classList.toggle('burger--mobile-tab');
                                    burger.classList.toggle('isOpen');
        
                                    mobileTab.classList.toggle('open');
                                    
                                    mobileSliderTab.slideTo(ordinalNumber - 1);
                                })
                            }
                        });
                    });

                    burger.addEventListener('click', function() {
                        if (burger.classList.contains('burger--mobile-tab')) {
                            allMobileTabs.forEach(function(tab) {
                                if (tab.classList.contains('open')) {
                                    tab.classList.remove('open');
                                }
                            })
                            burger.classList.remove('burger--mobile-tab');
                            burger.classList.add('burger--menu');
                        }
                    });
                }
            })
        })
    }
}

initializeMobileTabs(document.querySelectorAll('[data-mobile-tab-links]'));
function switchingTabs(allTabsBtns, allTabs, tabsContent) {
    if (tabsContent) {
        allTabsBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let serialNumber = this.getAttribute('data-tab-btn');
                let currentActiveTab = tabsContent.querySelector('.active');
                
                if (currentActiveTab.getAttribute('data-tab') === serialNumber) {
                    return
                } else {
                    allTabs.forEach(function(tab) {
                        tab.classList.remove('active');
                        tab.classList.remove('show');
                        tab.classList.add('none');
                        if(tab.getAttribute('data-tab') === serialNumber) {
                            tab.classList.add('active');
                            tab.classList.remove('none');
                        }
                    });
                }
            }); 
        });
    }
}

function switchingSecondTabs(allTabsBtns, allTabs, tabsContent) {
    if (tabsContent) {
        allTabsBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                let serialNumber = this.getAttribute('data-second-tab-btn');
                let currentActiveTab = tabsContent.querySelector('.open');

                if (currentActiveTab ? currentActiveTab.getAttribute('data-second-tab') === serialNumber : false) {
                    return
                } else {
                    allTabs.forEach(function(tab) {
                        tab.classList.remove('open');
                        tab.classList.remove('show');
                        tab.classList.add('none');
                        if(tab.getAttribute('data-second-tab') === serialNumber) {
                            tab.classList.add('open');
                            tab.classList.remove('none');
                        }
                    });
                }
            }); 
        });
    }
}

switchingTabs(document.querySelectorAll('.contacts [data-tab-btn]'), document.querySelectorAll('.contacts [data-tab]'), document.querySelector('.contacts__content'))
switchingTabs(document.querySelectorAll('.team [data-tab-btn]'), document.querySelectorAll('.team [data-tab]'), document.querySelector('.team__content'));
switchingTabs(document.querySelectorAll('.history [data-tab-btn]'), document.querySelectorAll('.history [data-tab]'), document.querySelector('.history__content'));

document.querySelectorAll('.services__item-content-products-items').forEach(function(tab) {
    switchingSecondTabs(tab.querySelectorAll('.services__item-content-products-items-tags [data-second-tab-btn]'), tab.querySelectorAll('.services__item-content-products-items-scope [data-second-tab]'), tab);
});


// SERVICE ITEMS
document.querySelectorAll('.services__item-content').forEach(function(item) {
    if (item) {
        item.querySelectorAll('.services__item-content-links .arrow-link').forEach(function(btn) {
            btn.addEventListener('click', function() {
                let serialNumber = this.getAttribute('data-tab-btn');
                let currentActiveTab = this.parentElement.parentElement.querySelector('.services__item-content-products .active');

                console.log(this.parentElement.parentElement)

                if (currentActiveTab.getAttribute('data-tab') === serialNumber) {
                    return
                } else {
                    this.parentElement.parentElement.querySelectorAll('.services__item-content-products-items').forEach(function(tab) {
                        tab.classList.remove('active');
                        tab.classList.remove('show');
                        tab.classList.add('none');
                        if(tab.getAttribute('data-tab') === serialNumber) {
                            tab.classList.add('active');
                            tab.classList.remove('none');
                        }
                    });
                }
            });
        });
    }
});
function addClassOnEyeContactTitle(elements, timeout) {
    if (elements) {        
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(function() {
                        entry.target.classList.add('show');
                    }, timeout);
                }
            });
        });
        
        if (elements.length) {
            elements.forEach(element => {
                observer.observe(element);
            });
        } else { observer.observe(elements) }
    }
}

function titleAnimation(allTitles) {
    if (allTitles) {
        allTitles.forEach(function(title, index) {
            if (window.innerWidth <= 500) {
                title.querySelectorAll('span').forEach(function(word) {
                    let wordContent = word.innerHTML;
                    let template = wordContent.split('').map( (l,i) => `<span class="char${i + 1}">${l == ' ' ? '&nbsp;' : l}</span>` ).join('');
                });
            } else { 

            }

            const template = title.getAttribute('data-title').split('').map( (l,i) => `<span class="char${i + 1}">${l == ' ' ? '&nbsp;' : l}</span>` ).join('');
            title.innerHTML = '';
            title.innerHTML += template;
    
            title.querySelectorAll('span').forEach(function(char, index) {
                addClassOnEyeContactTitle(char, 100 * (index + 0.5));
            });
        });
    }
}


titleAnimation(document.querySelectorAll('.services__item h1'));
titleAnimation(document.querySelectorAll('.menu__list-item h1'));
titleAnimation(document.querySelectorAll('.g-title'));
