<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_association_script.html.twig */
class __TwigTemplate_837186d7b3999fad2c8814213249a63cb963f673dc2b6facbb15fd501039263a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_association_script.html.twig"));

        // line 11
        echo "

";
        // line 18
        echo "
";
        // line 20
        echo "
";
        // line 22
        echo "
";
        // line 23
        $context["associationadmin"] = $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array());
        // line 24
        echo "
<!-- edit many association -->

<script type=\"text/javascript\">

    ";
        // line 34
        echo "
    var field_dialog_form_list_link_";
        // line 35
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = function(event) {
        initialize_popup_";
        // line 36
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        var target = jQuery(this);

        if (target.attr('href').length === 0 || target.attr('href') === '#') {
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        Admin.log('[";
        // line 47
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_link] handle link click in a list');

        var element = jQuery(this).parents('#field_dialog_";
        // line 49
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " .sonata-ba-list-field');

        // the user does not click on a row column
        if (element.length == 0) {
            Admin.log('[";
        // line 53
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_link] the user does not click on a row column, make ajax call to retrieve inner html');
            // make a recursive call (ie: reset the filter)
            jQuery.ajax({
                type: 'GET',
                url: jQuery(this).attr('href'),
                dataType: 'html',
                success: function(html) {
                    Admin.log('[";
        // line 60
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_link] callback success, attach valid js event');

                    field_dialog_content_";
        // line 62
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(html);
                    field_dialog_form_list_handle_action_";
        // line 63
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

                    Admin.shared_setup(field_dialog_";
        // line 65
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
                }
            });

            return;
        }

        Admin.log('[";
        // line 72
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_link] the user select one element, update input and hide the modal');

        jQuery('#";
        // line 74
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "').val(element.attr('objectId'));
        jQuery('#";
        // line 75
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "').trigger('change');

        field_dialog_";
        // line 77
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".modal('hide');
    };

    // this function handle action on the modal list when inside a selected list
    var field_dialog_form_list_handle_action_";
        // line 81
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "  =  function() {
        Admin.log('[";
        // line 82
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_handle_action] attaching valid js event');

        // capture the submit event to make an ajax call, ie : POST data to the
        // related create admin
        jQuery('a', field_dialog_";
        // line 86
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").on('click', field_dialog_form_list_link_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
        jQuery('form', field_dialog_";
        // line 87
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").on('submit', function(event) {
            event.preventDefault();

            var form = jQuery(this);

            Admin.log('[";
        // line 92
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_handle_action] catching submit event, sending ajax request');

            jQuery(form).ajaxSubmit({
                type: form.attr('method'),
                url: form.attr('action'),
                dataType: 'html',
                data: {_xml_http_request: true},
                success: function(html) {

                    Admin.log('[";
        // line 101
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list_handle_action] form submit success, restoring event');

                    field_dialog_content_";
        // line 103
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(html);
                    field_dialog_form_list_handle_action_";
        // line 104
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

                    Admin.shared_setup(field_dialog_";
        // line 106
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
                }
            });
        });
    };

    // handle the list link
    var field_dialog_form_list_";
        // line 113
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = function(event) {

        initialize_popup_";
        // line 115
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        event.preventDefault();
        event.stopPropagation();

        Admin.log('[";
        // line 120
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list] open the list modal');

        var a = jQuery(this);

        field_dialog_content_";
        // line 124
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html('');

        // retrieve the form element from the related admin generator
        jQuery.ajax({
            url: a.attr('href'),
            dataType: 'html',
            success: function(html) {

                Admin.log('[";
        // line 132
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_list] retrieving the list content');

                // populate the popup container
                field_dialog_content_";
        // line 135
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(html);

                field_dialog_title_";
        // line 137
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "label", array()), array(), $this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "translationdomain", array()));
        echo "\");

                Admin.shared_setup(field_dialog_";
        // line 139
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                field_dialog_form_list_handle_action_";
        // line 141
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

                // open the dialog in modal mode
                field_dialog_";
        // line 144
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".modal();

                Admin.setup_list_modal(field_dialog_";
        // line 146
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
            }
        });
    };

    // handle the add link
    var field_dialog_form_add_";
        // line 152
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = function(event) {
        initialize_popup_";
        // line 153
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        event.preventDefault();
        event.stopPropagation();

        var a = jQuery(this);

        field_dialog_content_";
        // line 160
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html('');

        Admin.log('[";
        // line 162
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_add] add link action');

        // retrieve the form element from the related admin generator
        jQuery.ajax({
            url: a.attr('href'),
            dataType: 'html',
            success: function(html) {

                Admin.log('[";
        // line 170
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_add] ajax success', field_dialog_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // populate the popup container
                field_dialog_content_";
        // line 173
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(html);
                field_dialog_title_";
        // line 174
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "label", array()), array(), $this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "translationdomain", array()));
        echo "\");

                Admin.shared_setup(field_dialog_";
        // line 176
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // capture the submit event to make an ajax call, ie : POST data to the
                // related create admin
                jQuery('a', field_dialog_";
        // line 180
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").on('click', field_dialog_form_action_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
                jQuery('form', field_dialog_";
        // line 181
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").on('submit', field_dialog_form_action_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // open the dialog in modal mode
                field_dialog_";
        // line 184
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".modal();

                Admin.setup_list_modal(field_dialog_";
        // line 186
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
            }
        });
    };

    // handle the edit link
    var field_dialog_form_edit_";
        // line 192
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = function(event) {
        initialize_popup_";
        // line 193
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        event.preventDefault();
        event.stopPropagation();

        var a = jQuery(this);

        field_dialog_content_";
        // line 200
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html('');

        Admin.log('[";
        // line 202
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_edit] edit link action');

        // retrieve the form element from the related admin generator
        jQuery.ajax({
            url: a.attr('href'),
            dataType: 'html',
            success: function(html) {

                Admin.log('[";
        // line 210
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_edit] ajax success', field_dialog_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // populate the popup container
                field_dialog_content_";
        // line 213
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(html);
                field_dialog_title_";
        // line 214
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "label", array()), array(), $this->getAttribute((isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "translationdomain", array()));
        echo "\");

                Admin.shared_setup(field_dialog_";
        // line 216
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // capture the submit event to make an ajax call, ie : POST data to the
                // related create admin
                jQuery('a', field_dialog_";
        // line 220
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").on('click', field_dialog_form_action_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
                jQuery('form', field_dialog_";
        // line 221
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").on('submit', field_dialog_form_action_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // open the dialog in modal mode
                field_dialog_";
        // line 224
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".modal();

                Admin.setup_list_modal(field_dialog_";
        // line 226
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
            }
        });
    };

    // handle the post data
    var field_dialog_form_action_";
        // line 232
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = function(event) {

        var element = jQuery(this);

        // return if the link is an anchor inside the same page
        if (
            this.nodeName === 'A'
            && (
                element.attr('href').length === 0
                || element.attr('href')[0] === '#'
                || element.attr('href').substr(0, 11) === 'javascript:'
            )
        ) {
            Admin.log('[";
        // line 245
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_action] element is an anchor or a script, skipping action', this);
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        Admin.log('[";
        // line 252
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_action] action catch', this);

        initialize_popup_";
        // line 254
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        if (this.nodeName == 'FORM') {
            var url  = element.attr('action');
            var type = element.attr('method');
        } else if (this.nodeName == 'A') {
            var url  = element.attr('href');
            var type = 'GET';
        } else {
            alert('unexpected element : @' + this.nodeName + '@');
            return;
        }

        if (element.hasClass('sonata-ba-action')) {
            Admin.log('[";
        // line 268
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_action] reserved action stop catch all events');
            return;
        }

        var data = {
            _xml_http_request: true
        }

        var form = jQuery(this);

        Admin.log('[";
        // line 278
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_action] execute ajax call');

        // the ajax post
        jQuery(form).ajaxSubmit({
            url: url,
            type: type,
            data: data,
            success: function(data) {
                Admin.log('[";
        // line 286
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog_form_action] ajax success');

                // if the crud action return ok, then the element has been added
                // so the widget container must be refresh with the last option available
                if (typeof data != 'string' && data.result == 'ok') {
                    field_dialog_";
        // line 291
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".modal('hide');

                    ";
        // line 293
        if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) == "list")) {
            // line 294
            echo "                        ";
            // line 298
            echo "                        jQuery('#";
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').val(data.objectId);
                        jQuery('#";
            // line 299
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').change();

                    ";
        } else {
            // line 302
            echo "
                        // reload the form element
                        jQuery('#field_widget_";
            // line 304
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').closest('form').ajaxSubmit({
                            url: '";
            // line 305
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("sonata_admin_retrieve_form_element", array("elementId" =>             // line 306
(isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "subclass" => $this->getAttribute($this->getAttribute(            // line 307
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin", array()), "getActiveSubclassCode", array(), "method"), "objectId" => $this->getAttribute($this->getAttribute($this->getAttribute(            // line 308
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin", array()), "root", array()), "id", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin", array()), "root", array()), "subject", array())), "method"), "uniqid" => $this->getAttribute($this->getAttribute($this->getAttribute(            // line 309
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin", array()), "root", array()), "uniqid", array()), "code" => $this->getAttribute($this->getAttribute($this->getAttribute(            // line 310
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin", array()), "root", array()), "code", array())));
            // line 311
            echo "',
                            data: {_xml_http_request: true },
                            dataType: 'html',
                            type: 'POST',
                            success: function(html) {
                                jQuery('#field_container_";
            // line 316
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').replaceWith(html);
                                var newElement = jQuery('#";
            // line 317
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo " [value=\"' + data.objectId + '\"]');
                                if (newElement.is(\"input\")) {
                                    newElement.attr('checked', 'checked');
                                } else {
                                    newElement.attr('selected', 'selected');
                                }

                                jQuery('#field_container_";
            // line 324
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').trigger('sonata-admin-append-form-element');
                            }
                        });

                    ";
        }
        // line 329
        echo "
                    return;
                }

                // otherwise, display form error
                field_dialog_content_";
        // line 334
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ".html(data);

                Admin.shared_setup(field_dialog_";
        // line 336
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

                // reattach the event
                jQuery('form', field_dialog_";
        // line 339
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ").submit(field_dialog_form_action_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
            }
        });

        return false;
    };

    var field_dialog_";
        // line 346
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "         = false;
    var field_dialog_content_";
        // line 347
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = false;
    var field_dialog_title_";
        // line 348
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "   = false;

    function initialize_popup_";
        // line 350
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "() {
        // initialize component
        if (!field_dialog_";
        // line 352
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ") {
            field_dialog_";
        // line 353
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "         = jQuery(\"#field_dialog_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "\");
            field_dialog_content_";
        // line 354
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo " = jQuery(\".modal-body\", \"#field_dialog_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "\");
            field_dialog_title_";
        // line 355
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "   = jQuery(\".modal-title\", \"#field_dialog_";
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "\");

            // move the dialog as a child of the root element, nested form breaks html ...
            jQuery(document.body).append(field_dialog_";
        // line 358
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");

            Admin.log('[";
        // line 360
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "|field_dialog] move dialog container as a document child');
        }
    }

    ";
        // line 367
        echo "    // this function initialize the popup
    // this can be only done this way has popup can be cascaded
    function start_field_dialog_form_add_";
        // line 369
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "(link) {

        // remove the html event
        link.onclick = null;

        initialize_popup_";
        // line 374
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        // add the jQuery event to the a element
        jQuery(link)
            .click(field_dialog_form_add_";
        // line 378
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ")
            .trigger('click')
        ;

        return false;
    }

    ";
        // line 388
        echo "    // this function initializes the popup
    // this can only be done this way as popup can be cascaded
    function start_field_dialog_form_edit_";
        // line 390
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "(link) {

        // remove the html event
        link.onclick = null;

        initialize_popup_";
        // line 395
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo "();

        // add the jQuery event to the a element
        jQuery(link)
            .click(field_dialog_form_edit_";
        // line 399
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ")
            .trigger('click')
        ;

        return false;
    }

    if (field_dialog_";
        // line 406
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ") {
        Admin.shared_setup(field_dialog_";
        // line 407
        echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
        echo ");
    }

    ";
        // line 410
        if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) == "list")) {
            // line 411
            echo "        ";
            // line 414
            echo "        // this function initialize the popup
        // this can be only done this way has popup can be cascaded
        function start_field_dialog_form_list_";
            // line 416
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "(link) {

            link.onclick = null;

            initialize_popup_";
            // line 420
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "();

            // add the jQuery event to the a element
            jQuery(link)
                .click(field_dialog_form_list_";
            // line 424
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo ")
                .trigger('click')
            ;

            return false;
        }

        function remove_selected_element_";
            // line 431
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "(link) {

            link.onclick = null;

            jQuery(link)
                .click(field_remove_element_";
            // line 436
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo ")
                .trigger('click')
            ;

            return false;
        }

        function field_remove_element_";
            // line 443
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "(event) {
            event.preventDefault();

            if (jQuery('#";
            // line 446
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo " option').get(0)) {
                jQuery('#";
            // line 447
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').attr('selectedIndex', '-1').children(\"option:selected\").attr(\"selected\", false);
            }

            jQuery('#";
            // line 450
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').val('');
            jQuery('#";
            // line 451
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').trigger('change');

            return false;
        }
        ";
            // line 458
            echo "
        // update the label
        jQuery('#";
            // line 460
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').on('change', function(event) {

            Admin.log('[";
            // line 462
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "|on:change] update the label');

            jQuery('#field_widget_";
            // line 464
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').html(\"<span><img src=\\\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/sonataadmin/ajax-loader.gif");
            echo "\\\" style=\\\"vertical-align: middle; margin-right: 10px\\\"/>";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("loading_information", array(), "SonataAdminBundle");
            echo "</span>\");
            jQuery.ajax({
                type: 'GET',
                url: '";
            // line 467
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("sonata_admin_short_object_information", array("objectId" => "OBJECT_ID", "uniqid" => $this->getAttribute(            // line 469
(isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "uniqid", array()), "code" => $this->getAttribute(            // line 470
(isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "code", array()), "linkParameters" => $this->getAttribute($this->getAttribute($this->getAttribute(            // line 471
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "options", array()), "link_parameters", array())));
            // line 472
            echo "'.replace('OBJECT_ID', jQuery(this).val()),
                dataType: 'html',
                success: function(html) {
                    jQuery('#field_widget_";
            // line 475
            echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
            echo "').html(html);
                }
            });

            ";
            // line 479
            if ((isset($context["btn_edit"]) ? $context["btn_edit"] : $this->getContext($context, "btn_edit"))) {
                // line 480
                echo "                var edit_button_url = '";
                echo $this->getAttribute(                // line 481
(isset($context["associationadmin"]) ? $context["associationadmin"] : $this->getContext($context, "associationadmin")), "generateUrl", array(0 => "edit", 1 => array("id" => "OBJECT_ID")), "method");
                // line 482
                echo "'.replace('OBJECT_ID', jQuery(this).val());

                jQuery('#field_actions_";
                // line 484
                echo (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"));
                echo " a.btn-warning').attr('href', edit_button_url);
            ";
            }
            // line 486
            echo "        });

    ";
        }
        // line 489
        echo "

</script>
<!-- / edit many association -->

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_association_script.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  869 => 489,  864 => 486,  859 => 484,  855 => 482,  853 => 481,  851 => 480,  849 => 479,  842 => 475,  837 => 472,  835 => 471,  834 => 470,  833 => 469,  832 => 467,  822 => 464,  817 => 462,  812 => 460,  808 => 458,  801 => 451,  797 => 450,  791 => 447,  787 => 446,  781 => 443,  771 => 436,  763 => 431,  753 => 424,  746 => 420,  739 => 416,  735 => 414,  733 => 411,  731 => 410,  725 => 407,  721 => 406,  711 => 399,  704 => 395,  696 => 390,  692 => 388,  682 => 378,  675 => 374,  667 => 369,  663 => 367,  656 => 360,  651 => 358,  643 => 355,  637 => 354,  631 => 353,  627 => 352,  622 => 350,  617 => 348,  613 => 347,  609 => 346,  597 => 339,  591 => 336,  586 => 334,  579 => 329,  571 => 324,  561 => 317,  557 => 316,  550 => 311,  548 => 310,  547 => 309,  546 => 308,  545 => 307,  544 => 306,  543 => 305,  539 => 304,  535 => 302,  529 => 299,  524 => 298,  522 => 294,  520 => 293,  515 => 291,  507 => 286,  496 => 278,  483 => 268,  466 => 254,  461 => 252,  451 => 245,  435 => 232,  426 => 226,  421 => 224,  413 => 221,  407 => 220,  400 => 216,  393 => 214,  389 => 213,  381 => 210,  370 => 202,  365 => 200,  355 => 193,  351 => 192,  342 => 186,  337 => 184,  329 => 181,  323 => 180,  316 => 176,  309 => 174,  305 => 173,  297 => 170,  286 => 162,  281 => 160,  271 => 153,  267 => 152,  258 => 146,  253 => 144,  247 => 141,  242 => 139,  235 => 137,  230 => 135,  224 => 132,  213 => 124,  206 => 120,  198 => 115,  193 => 113,  183 => 106,  178 => 104,  174 => 103,  169 => 101,  157 => 92,  149 => 87,  143 => 86,  136 => 82,  132 => 81,  125 => 77,  120 => 75,  116 => 74,  111 => 72,  101 => 65,  96 => 63,  92 => 62,  87 => 60,  77 => 53,  70 => 49,  65 => 47,  51 => 36,  47 => 35,  44 => 34,  37 => 24,  35 => 23,  32 => 22,  29 => 20,  26 => 18,  22 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#

This file is part of the Sonata package.

(c) Thomas Rabaix <thomas.rabaix@sonata-project.org>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

#}


{#

This code manage the many-to-[one|many] association field popup

#}

{% sonata_template_deprecate '@SonataAdmin/CRUD/Association/edit_many_script.html.twig' %}

{% autoescape false %}

{% set associationadmin = sonata_admin.field_description.associationadmin %}

<!-- edit many association -->

<script type=\"text/javascript\">

    {#
      handle link click in a list :
        - if the parent has an objectId defined then the related input get updated
        - if the parent has NO object then an ajax request is made to refresh the popup
    #}

    var field_dialog_form_list_link_{{ id }} = function(event) {
        initialize_popup_{{ id }}();

        var target = jQuery(this);

        if (target.attr('href').length === 0 || target.attr('href') === '#') {
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        Admin.log('[{{ id }}|field_dialog_form_list_link] handle link click in a list');

        var element = jQuery(this).parents('#field_dialog_{{ id }} .sonata-ba-list-field');

        // the user does not click on a row column
        if (element.length == 0) {
            Admin.log('[{{ id }}|field_dialog_form_list_link] the user does not click on a row column, make ajax call to retrieve inner html');
            // make a recursive call (ie: reset the filter)
            jQuery.ajax({
                type: 'GET',
                url: jQuery(this).attr('href'),
                dataType: 'html',
                success: function(html) {
                    Admin.log('[{{ id }}|field_dialog_form_list_link] callback success, attach valid js event');

                    field_dialog_content_{{ id }}.html(html);
                    field_dialog_form_list_handle_action_{{ id }}();

                    Admin.shared_setup(field_dialog_{{ id }});
                }
            });

            return;
        }

        Admin.log('[{{ id }}|field_dialog_form_list_link] the user select one element, update input and hide the modal');

        jQuery('#{{ id }}').val(element.attr('objectId'));
        jQuery('#{{ id }}').trigger('change');

        field_dialog_{{ id }}.modal('hide');
    };

    // this function handle action on the modal list when inside a selected list
    var field_dialog_form_list_handle_action_{{ id }}  =  function() {
        Admin.log('[{{ id }}|field_dialog_form_list_handle_action] attaching valid js event');

        // capture the submit event to make an ajax call, ie : POST data to the
        // related create admin
        jQuery('a', field_dialog_{{ id }}).on('click', field_dialog_form_list_link_{{ id }});
        jQuery('form', field_dialog_{{ id }}).on('submit', function(event) {
            event.preventDefault();

            var form = jQuery(this);

            Admin.log('[{{ id }}|field_dialog_form_list_handle_action] catching submit event, sending ajax request');

            jQuery(form).ajaxSubmit({
                type: form.attr('method'),
                url: form.attr('action'),
                dataType: 'html',
                data: {_xml_http_request: true},
                success: function(html) {

                    Admin.log('[{{ id }}|field_dialog_form_list_handle_action] form submit success, restoring event');

                    field_dialog_content_{{ id }}.html(html);
                    field_dialog_form_list_handle_action_{{ id }}();

                    Admin.shared_setup(field_dialog_{{ id }});
                }
            });
        });
    };

    // handle the list link
    var field_dialog_form_list_{{ id }} = function(event) {

        initialize_popup_{{ id }}();

        event.preventDefault();
        event.stopPropagation();

        Admin.log('[{{ id }}|field_dialog_form_list] open the list modal');

        var a = jQuery(this);

        field_dialog_content_{{ id }}.html('');

        // retrieve the form element from the related admin generator
        jQuery.ajax({
            url: a.attr('href'),
            dataType: 'html',
            success: function(html) {

                Admin.log('[{{ id }}|field_dialog_form_list] retrieving the list content');

                // populate the popup container
                field_dialog_content_{{ id }}.html(html);

                field_dialog_title_{{ id }}.html(\"{{ associationadmin.label|trans({}, associationadmin.translationdomain) }}\");

                Admin.shared_setup(field_dialog_{{ id }});

                field_dialog_form_list_handle_action_{{ id }}();

                // open the dialog in modal mode
                field_dialog_{{ id }}.modal();

                Admin.setup_list_modal(field_dialog_{{ id }});
            }
        });
    };

    // handle the add link
    var field_dialog_form_add_{{ id }} = function(event) {
        initialize_popup_{{ id }}();

        event.preventDefault();
        event.stopPropagation();

        var a = jQuery(this);

        field_dialog_content_{{ id }}.html('');

        Admin.log('[{{ id }}|field_dialog_form_add] add link action');

        // retrieve the form element from the related admin generator
        jQuery.ajax({
            url: a.attr('href'),
            dataType: 'html',
            success: function(html) {

                Admin.log('[{{ id }}|field_dialog_form_add] ajax success', field_dialog_{{ id }});

                // populate the popup container
                field_dialog_content_{{ id }}.html(html);
                field_dialog_title_{{ id }}.html(\"{{ associationadmin.label|trans({}, associationadmin.translationdomain) }}\");

                Admin.shared_setup(field_dialog_{{ id }});

                // capture the submit event to make an ajax call, ie : POST data to the
                // related create admin
                jQuery('a', field_dialog_{{ id }}).on('click', field_dialog_form_action_{{ id }});
                jQuery('form', field_dialog_{{ id }}).on('submit', field_dialog_form_action_{{ id }});

                // open the dialog in modal mode
                field_dialog_{{ id }}.modal();

                Admin.setup_list_modal(field_dialog_{{ id }});
            }
        });
    };

    // handle the edit link
    var field_dialog_form_edit_{{ id }} = function(event) {
        initialize_popup_{{ id }}();

        event.preventDefault();
        event.stopPropagation();

        var a = jQuery(this);

        field_dialog_content_{{ id }}.html('');

        Admin.log('[{{ id }}|field_dialog_form_edit] edit link action');

        // retrieve the form element from the related admin generator
        jQuery.ajax({
            url: a.attr('href'),
            dataType: 'html',
            success: function(html) {

                Admin.log('[{{ id }}|field_dialog_form_edit] ajax success', field_dialog_{{ id }});

                // populate the popup container
                field_dialog_content_{{ id }}.html(html);
                field_dialog_title_{{ id }}.html(\"{{ associationadmin.label|trans({}, associationadmin.translationdomain) }}\");

                Admin.shared_setup(field_dialog_{{ id }});

                // capture the submit event to make an ajax call, ie : POST data to the
                // related create admin
                jQuery('a', field_dialog_{{ id }}).on('click', field_dialog_form_action_{{ id }});
                jQuery('form', field_dialog_{{ id }}).on('submit', field_dialog_form_action_{{ id }});

                // open the dialog in modal mode
                field_dialog_{{ id }}.modal();

                Admin.setup_list_modal(field_dialog_{{ id }});
            }
        });
    };

    // handle the post data
    var field_dialog_form_action_{{ id }} = function(event) {

        var element = jQuery(this);

        // return if the link is an anchor inside the same page
        if (
            this.nodeName === 'A'
            && (
                element.attr('href').length === 0
                || element.attr('href')[0] === '#'
                || element.attr('href').substr(0, 11) === 'javascript:'
            )
        ) {
            Admin.log('[{{ id }}|field_dialog_form_action] element is an anchor or a script, skipping action', this);
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        Admin.log('[{{ id }}|field_dialog_form_action] action catch', this);

        initialize_popup_{{ id }}();

        if (this.nodeName == 'FORM') {
            var url  = element.attr('action');
            var type = element.attr('method');
        } else if (this.nodeName == 'A') {
            var url  = element.attr('href');
            var type = 'GET';
        } else {
            alert('unexpected element : @' + this.nodeName + '@');
            return;
        }

        if (element.hasClass('sonata-ba-action')) {
            Admin.log('[{{ id }}|field_dialog_form_action] reserved action stop catch all events');
            return;
        }

        var data = {
            _xml_http_request: true
        }

        var form = jQuery(this);

        Admin.log('[{{ id }}|field_dialog_form_action] execute ajax call');

        // the ajax post
        jQuery(form).ajaxSubmit({
            url: url,
            type: type,
            data: data,
            success: function(data) {
                Admin.log('[{{ id }}|field_dialog_form_action] ajax success');

                // if the crud action return ok, then the element has been added
                // so the widget container must be refresh with the last option available
                if (typeof data != 'string' && data.result == 'ok') {
                    field_dialog_{{ id }}.modal('hide');

                    {% if sonata_admin.edit == 'list' %}
                        {#
                           in this case we update the hidden input, and call the change event to
                           retrieve the post information
                        #}
                        jQuery('#{{ id }}').val(data.objectId);
                        jQuery('#{{ id }}').change();

                    {% else %}

                        // reload the form element
                        jQuery('#field_widget_{{ id }}').closest('form').ajaxSubmit({
                            url: '{{ path('sonata_admin_retrieve_form_element', {
                                'elementId': id,
                                'subclass':  sonata_admin.admin.getActiveSubclassCode(),
                                'objectId':  sonata_admin.admin.root.id(sonata_admin.admin.root.subject),
                                'uniqid':    sonata_admin.admin.root.uniqid,
                                'code':      sonata_admin.admin.root.code
                            }) }}',
                            data: {_xml_http_request: true },
                            dataType: 'html',
                            type: 'POST',
                            success: function(html) {
                                jQuery('#field_container_{{ id }}').replaceWith(html);
                                var newElement = jQuery('#{{ id }} [value=\"' + data.objectId + '\"]');
                                if (newElement.is(\"input\")) {
                                    newElement.attr('checked', 'checked');
                                } else {
                                    newElement.attr('selected', 'selected');
                                }

                                jQuery('#field_container_{{ id }}').trigger('sonata-admin-append-form-element');
                            }
                        });

                    {% endif %}

                    return;
                }

                // otherwise, display form error
                field_dialog_content_{{ id }}.html(data);

                Admin.shared_setup(field_dialog_{{ id }});

                // reattach the event
                jQuery('form', field_dialog_{{ id }}).submit(field_dialog_form_action_{{ id }});
            }
        });

        return false;
    };

    var field_dialog_{{ id }}         = false;
    var field_dialog_content_{{ id }} = false;
    var field_dialog_title_{{ id }}   = false;

    function initialize_popup_{{ id }}() {
        // initialize component
        if (!field_dialog_{{ id }}) {
            field_dialog_{{ id }}         = jQuery(\"#field_dialog_{{ id }}\");
            field_dialog_content_{{ id }} = jQuery(\".modal-body\", \"#field_dialog_{{ id }}\");
            field_dialog_title_{{ id }}   = jQuery(\".modal-title\", \"#field_dialog_{{ id }}\");

            // move the dialog as a child of the root element, nested form breaks html ...
            jQuery(document.body).append(field_dialog_{{ id }});

            Admin.log('[{{ id }}|field_dialog] move dialog container as a document child');
        }
    }

    {#
        This code is used to defined the \"add\" popup
    #}
    // this function initialize the popup
    // this can be only done this way has popup can be cascaded
    function start_field_dialog_form_add_{{ id }}(link) {

        // remove the html event
        link.onclick = null;

        initialize_popup_{{ id }}();

        // add the jQuery event to the a element
        jQuery(link)
            .click(field_dialog_form_add_{{ id }})
            .trigger('click')
        ;

        return false;
    }

    {#
        This code is used to define the \"edit\" popup
    #}
    // this function initializes the popup
    // this can only be done this way as popup can be cascaded
    function start_field_dialog_form_edit_{{ id }}(link) {

        // remove the html event
        link.onclick = null;

        initialize_popup_{{ id }}();

        // add the jQuery event to the a element
        jQuery(link)
            .click(field_dialog_form_edit_{{ id }})
            .trigger('click')
        ;

        return false;
    }

    if (field_dialog_{{ id }}) {
        Admin.shared_setup(field_dialog_{{ id }});
    }

    {% if sonata_admin.edit == 'list' %}
        {#
            This code is used to defined the \"list\" popup
        #}
        // this function initialize the popup
        // this can be only done this way has popup can be cascaded
        function start_field_dialog_form_list_{{ id }}(link) {

            link.onclick = null;

            initialize_popup_{{ id }}();

            // add the jQuery event to the a element
            jQuery(link)
                .click(field_dialog_form_list_{{ id }})
                .trigger('click')
            ;

            return false;
        }

        function remove_selected_element_{{ id }}(link) {

            link.onclick = null;

            jQuery(link)
                .click(field_remove_element_{{ id}})
                .trigger('click')
            ;

            return false;
        }

        function field_remove_element_{{ id }}(event) {
            event.preventDefault();

            if (jQuery('#{{ id }} option').get(0)) {
                jQuery('#{{ id }}').attr('selectedIndex', '-1').children(\"option:selected\").attr(\"selected\", false);
            }

            jQuery('#{{ id }}').val('');
            jQuery('#{{ id }}').trigger('change');

            return false;
        }
        {#
          attach onchange event on the input
        #}

        // update the label
        jQuery('#{{ id }}').on('change', function(event) {

            Admin.log('[{{ id }}|on:change] update the label');

            jQuery('#field_widget_{{ id }}').html(\"<span><img src=\\\"{{ asset('bundles/sonataadmin/ajax-loader.gif') }}\\\" style=\\\"vertical-align: middle; margin-right: 10px\\\"/>{{ 'loading_information'|trans([], 'SonataAdminBundle') }}</span>\");
            jQuery.ajax({
                type: 'GET',
                url: '{{ path('sonata_admin_short_object_information', {
                    'objectId': 'OBJECT_ID',
                    'uniqid': associationadmin.uniqid,
                    'code': associationadmin.code,
                    'linkParameters': sonata_admin.field_description.options.link_parameters
                })}}'.replace('OBJECT_ID', jQuery(this).val()),
                dataType: 'html',
                success: function(html) {
                    jQuery('#field_widget_{{ id }}').html(html);
                }
            });

            {% if btn_edit %}
                var edit_button_url = '{{
                    associationadmin.generateUrl('edit', {'id' : 'OBJECT_ID'})
                }}'.replace('OBJECT_ID', jQuery(this).val());

                jQuery('#field_actions_{{ id }} a.btn-warning').attr('href', edit_button_url);
            {% endif %}
        });

    {% endif %}


</script>
<!-- / edit many association -->

{% endautoescape %}
", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_association_script.html.twig", "/var/www/html/UserDemo/vendor/sonata-project/doctrine-orm-admin-bundle/src/Resources/views/CRUD/edit_orm_many_association_script.html.twig");
    }
}
