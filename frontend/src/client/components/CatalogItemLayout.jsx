import React from 'react';
import styled from 'styled-components';
import {colors} from '../libs/variables';
import {Container} from '../libs/blocks';
import Breadcrumbs from './Breadcrumbs';

const Catalog = styled.div`
    background-color: ${colors.white};
    padding: 0 15px;
    
`;
const Catalog__Container = styled(Container)`
    background-color: ${colors.white};
`;

export default class CatalogItemLayout extends React.Component {

    render() {
        return (
            <Catalog>
                <Catalog__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                </Catalog__Container>
            </Catalog>
        )
    }
}
