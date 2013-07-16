map_parent_child = Object();
map_child_parent = Object();
m_h_i_init = false;

$(document).ready( function() {
    if (!m_h_i_init) {
        m_h_i_init = true;

        var child_nodes = Object();
        child_nodes['display_control'] = $('.multi_dependent');
        child_nodes['options_control'] = $('.multi_subordinate');

        map_parent_child['display_control'] = Object();
        map_parent_child['options_control'] = Object();

        function reset(node) {
            if ($(node).is('select')) {
                $(node).find('option').remove().end().append('<option value="">None</option>');
            }
        }

        function update_visibility(parent_node) {
            child_nodes = map_parent_child['display_control'][parent_node];

            $.each(child_nodes, function(index, child_node) {
                parents = map_child_parent['display_control'][child_node];
                var data = Object();
                var url = $(child_node).attr('data-multi-dependent-interaction');

                $.each(parents, function(index, par_node) {
                    data[$('#' + par_node).attr('name')] = $('#' + par_node).val();
                });

                $.getJSON(
                    url,
                    data,
                    function(data) {
                        if (!data) {
                            $(child_node).hide();
                        }
                        else {
                            $(child_node).show();
                        }
                    }
                );
            });
        }

        function update_values(parent_node) {
            child_nodes = map_parent_child['options_control'][parent_node];

            $.each(child_nodes, function(index, child_node) {
                parents = map_child_parent['options_control'][child_node];
                var data = Object();
                var url = $(child_node).attr('data-multi-subordinate-interaction');

                $.each(parents, function(index, par_node) {
                    data[$('#' + par_node).attr('name')] = $('#' + par_node).val();
                });

                reset(child_node);

                $.getJSON(
                    url,
                    data,
                    function(data) {
                        if (data.length > 0) {
                            for (var key in data) {
                                $(child_node).append('<option value="' + data[key]['name'] + '">' + data[key]['value'] + '</option>');
                            }
                        }
                    }
                );
            });
        }

        $.each(child_nodes['display_control'], function(index, node) {
            var parents = $(node).attr('data-multi-dependent').split(' ');

            if (map_child_parent['display_control'] == undefined)
                map_child_parent['display_control'] = Object();

            map_child_parent['display_control'][node] = [];

            $.each(parents, function(index, parent_node) {

                if (map_parent_child['display_control'][parent_node] == undefined) {
                    map_parent_child['display_control'][parent_node] = [node];
                }
                else {
                    map_parent_child['display_control'][parent_node].push(node);
                }
                map_child_parent['display_control'][node].push(parent_node);

                $('#' + parent_node).on('change', function(event) {
                    update_visibility(parent_node);
                });
            });
        });

        $.each(child_nodes['options_control'], function(index, node) {
            var parents = $(node).attr('data-multi-subordinate').split(' ');
            if (map_child_parent['options_control'] == undefined)
                map_child_parent['options_control'] = Object();
            map_child_parent['options_control'][node] = [];

            $.each(parents, function(index, parent_node) {

                if (map_parent_child['options_control'][parent_node] == undefined) {
                    map_parent_child['options_control'][parent_node] = [node];
                }
                else {
                    map_parent_child['options_control'][parent_node].push(node);
                }
                map_child_parent['options_control'][node].push(parent_node);

                $('#' + parent_node).on('change', function(event) {
                    update_values(parent_node);
                });
            });
        });
    }
});
