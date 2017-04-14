import React from 'react';
import styled from 'styled-components';

import FormInputRadio from './FormInputRadio';

const FormRadioStyled = styled.div`
    
`;

export default class FormRadio extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            isActive: props.active
        }
    }

    handleClick = () => {
        this.setState(_ => ({
            isActive: !_.isActive
        }));
    };

    static propTypes = {
        items: React.PropTypes.array
    };

    static defaultProps = {
        items: [
            {
                name: 'test',
                value: 'Test',
                title: 'Авторизация',
            }
        ]
    };

    render() {
        return (
            <FormRadioStyled>
                {this.props.items.map((radio, index) =>
                    <FormInputRadio {...radio} key={index}/>
                )}
            </FormRadioStyled>
        )
    }
}
