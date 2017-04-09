import React from 'react';
import styled from 'styled-components';
import {colors, fontSizes} from '../libs/variables';
import {Container} from '../libs/blocks';
import Breadcrumbs from './Breadcrumbs';

const Catalog = styled.div`
    background-color: ${colors.white};
`;
const Catalog__Container = styled(Container)`
    background-color: ${colors.white};
`;
const Catalog__Header = styled.header`
    background-color: ${colors.white};
    font-size: ${fontSizes.xxl};
    font-weight: 800;
`;
const Catalog__Content = styled.section`
    padding: 15px;
`;

export default class CatalogLayout extends React.Component {
    render() {
        return (
            <Catalog>
                <Catalog__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Catalog__Header>{this.props.title}</Catalog__Header>
                    <Catalog__Content>

                    </Catalog__Content>
                </Catalog__Container>
            </Catalog>
        )
    }
}
