import React from 'react';
import styled from 'styled-components';

import FormInputRadio from './FormInputRadio';

const FormRadioStyled = styled.div`
    
`;
const Radio = styled.div`
    padding-bottom: 5px;
    
    &:last-child: {
        padding-bottom: 0;
    }
`;

export default class FormRadio extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            isActive: props.active,
            flushFunctions: []
        }
    }

    handleClick = () => {
        this.setState(_ => ({
            isActive: !_.isActive
        }));
    };

    collectRadioFlushFunc = (flushFunc) => {
        this.setState(_ => ({
            flushFunctions: [..._.flushFunctions, flushFunc]
        }));
    };

    flushRadioCollection = () => {
        this.state.flushFunctions.map(func =>
            func()
        );
    };

    static propTypes = {
        items: React.PropTypes.array
    };

    static defaultProps = {
        items: []
    };

    render() {
        return (
            <FormRadioStyled>
                {this.props.items.map((radio, index) =>
                    <Radio key={index}>
                        <FormInputRadio {...radio}
                                        collectRadioFlushFunc={this.collectRadioFlushFunc}
                                        flushRadioCollection={this.flushRadioCollection}/>
                    </Radio>
                )}
            </FormRadioStyled>
        )
    }
}
