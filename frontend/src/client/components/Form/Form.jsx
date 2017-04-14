import React from 'react';
import styled from 'styled-components';

import FormButton from './FormButton';
import Dom from '../../../core/scripts/dom';

const FormStyled = styled.section`
`;
const Buttons = styled.div`
    text-align: right;
`;

const FORM_ID = 'sendForm';

export default class Form extends React.Component {

    handleSendForm = (e) => {
        e.preventDefault();

        const params = Dom.formItems(FORM_ID);
        this.props.handle(params);
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
