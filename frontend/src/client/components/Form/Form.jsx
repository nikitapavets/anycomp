import React from 'react';
import styled from 'styled-components';

import FormButton from './FormButton';
import Dom from '../../../core/scripts/dom';

const FormStyled = styled.section`
`;
const Buttons = styled.div`
    text-align: right;
    margin-top: 15px;
`;

const FORM_ID = 'sendForm';

export default class Form extends React.Component {

    handleSendForm = (e) => {
        e.preventDefault();

        const params = Dom.formItems(this.props.id);
        this.props.handle(params, this.props.handleParams);
    };

    static defaultProps = {
        id: FORM_ID
    };

    render() {
        return (
            <FormStyled>
                <form id={this.props.id}>
                    {this.props.children}
                    <Buttons>
                        <FormButton title={this.props.button} handleClick={this.handleSendForm}/>
                    </Buttons>
                </form>
            </FormStyled>
        )
    }
}
