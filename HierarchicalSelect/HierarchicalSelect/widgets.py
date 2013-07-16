"""This file contains various widgets to be used across delhivery"""

from django import forms
from django.forms.widgets import MultiWidget
from django.forms.extras.widgets import SelectDateWidget
from django.forms.widgets import SplitDateTimeWidget, TimeInput, Select
from django.forms.widgets import Input
from django.forms.widgets import Textarea, DateInput
from django.utils import html
from django.utils.safestring import mark_safe
from django.utils.simplejson import JSONEncoder

from settings import JS_LAST_UPDATED


class MultiHierarchicalSelect(Select):

    class Media:
        """This class adds css/js needed for multiple hierarchical select widget"""
        js = ('js/multihierarchical_inputs.js?v={}'.format(JS_LAST_UPDATED),)

    def __init__(
            self, control_parents=None,
            visibility_parents=None, attrs=dict()):
        """Init function to call Select with right attributes"""

        # If use has specified his own class for styling purpose append
        # "subordinate-select" to the same otherwise set class to
        # "subordinate-select"
        additional_classes = []

        if control_parents:
            control_parent_ids, control_parent_url = control_parents
            control_parent_attrs = [
                'id_{}'.format(x) for x in control_parent_ids]
            additional_classes.append('multi_subordinate')
            attrs['data-multi-subordinate'] = ' '.join(control_parent_attrs)
            attrs['data-multi-subordinate-interaction'] = control_parent_url

        if visibility_parents:
            visibility_parent_ids, visibility_parent_url = visibility_parents
            visibility_parent_attrs = [
                'id_{}'.format(x) for x in visibility_parent_ids]
            additional_classes.append('multi_dependent')
            attrs['data-multi-dependent'] = ' '.join(visibility_parent_attrs)
            attrs['data-multi-dependent-interaction'] = visibility_parent_url

        if 'class' in attrs:
            attrs['class'] = '{} {}'.format(
                attrs['class'], ' '.join(additional_classes))
        else:
            attrs['class'] = '{}'.format(
                ' '.join(additional_classes))

        super(MultiHierarchicalSelect, self).__init__(attrs)
