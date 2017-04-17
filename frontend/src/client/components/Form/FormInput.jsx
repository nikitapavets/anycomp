import React from 'react';
import styled from 'styled-components';
import NumberFormat from 'react-number-format';

import {colors, fontSizes} from '../../libs/variables';
import {media} from '../../libs/mixins';

const FormInputStyled = styled.div`
    ${media.tablet`
        display: flex;
        margin: 15px 0;
        display: ${props => props.type == 'hidden' ? 'none' : 'flex'};
    `}
    display: ${props => props.type == 'hidden' ? 'none' : 'block'};
`;
const Title = styled.div`
    margin: 10px 0;
    font-size: ${fontSizes.s};
    &:after {
        content: ${props => props.required ? '"*"' : '""'};
        display: inline-block;
        color: ${colors.red};
    }
    ${media.tablet`
        flex: 1 1;
        text-align: right;
        margin-right: 30px;
    `}
`;
const Field = styled.div`
    ${media.tablet`
        flex: 2 1;
    `}
`;
const Input = styled.input`
    display: block;
    width: 100%;
    padding: 7px 10px;
    background: rgba(0, 0, 0, .05);
    border: none;
    outline: none;
    border: 2px solid rgba(0, 0, 0, .05);
    &:focus {
        border: 2px solid ${colors.minor};
    }
`;
const Error = styled.div`
    font-size: ${fontSizes.xs};
    color: ${colors.red};
    margin-top: 5px;
`;

export default class FormInput extends React.Component {

    static propTypes = {
        title: React.PropTypes.string,
        type: React.PropTypes.string
    };

    static defaultProps = {
        type: 'text'
    };

    render() {
        return (
            <FormInputStyled {...this.props}>
                <Title required={this.props.required}>{this.props.title}</Title>
                <Field>
                    {this.props.type == 'phone'
                        ? <NumberFormat name={this.props.name}
                                        value={this.props.value}
                                        data-type={this.props.type}
                                        data-required={this.props.required}
                                        customInput={Input}
                                        format='+###(##)###-##-##' mask='_'/>
                        : <Input name={this.props.name}
                                 defaultValue={this.props.value}
                                 type={this.props.type}
                                 data-validate={this.props.validate}
                                 data-required={this.props.required}/>
                    }
                    <Error className='error'>{this.props.error}</Error>
                </Field>
            </FormInputStyled>
        )
    }
}
