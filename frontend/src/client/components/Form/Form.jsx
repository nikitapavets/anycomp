import React from 'react';
import styled from 'styled-components';
import $ from 'jquery';

import FormButton from './FormButton';
import errors from './FormErrors';
import Dom from '../../../core/scripts/dom';

const FormStyled = styled.section`
`;
const Buttons = styled.div`
    text-align: right;
`;

const FORM_ID = 'sendForm';
const FROM_ERROR = 'error';

export default class Form extends React.Component {

    handleSendForm = (e) => {
        e.preventDefault();

        if(this.validateForm(FORM_ID)) {
            const params = Dom.formItems(FORM_ID);
            this.props.handle(params);
        }
    };

    validateForm = (formId) => {
        let validateStatus = true;
        const form = $(`#${formId}`);
        form.find(`.${FROM_ERROR}`).text('');
        form.find('input').each((index, input) => {
            if ($(input).data('required') && !$(input).val()) {
                $(input).next(`.${FROM_ERROR}`).text(errors.error_required);
                validateStatus = false;
            }
        });
        return validateStatus;
    };

    render() {
        return (
            <FormStyled>
                <form id={FORM_ID}>
                    {this.props.children}
                    <Buttons>
                        <FormButton title={this.props.button} handleClick={this.handleSendForm}/>
                    </Buttons>
                </form>
            </FormStyled>
        )
    }
}
